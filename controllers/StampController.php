<?php
namespace App\Controllers;

use App\Models\Color;
use App\Models\Country;
use App\Models\ImageToUpload;
use App\Models\Stamp;
use App\Models\StampCondition;
use App\Models\Theme;
use App\Providers\Auth;
use App\Providers\Validator;
use App\Providers\View;

class StampController
{
    public function __construct()
    {
        Auth::session();
    }

    public function create()
    {
        $color        = new Color;
        $selectColors = $color->select();

        $conditions      = new StampCondition;
        $selectCondition = $conditions->select();

        $country       = new Country;
        $selectCountry = $country->select();

        $theme       = new Theme;
        $selectTheme = $theme->select();

        return View::render('stamp/create', [
            'colors'     => $selectColors,
            'conditions' => $selectCondition,
            'countries'  => $selectCountry,
            'themes'     => $selectTheme,
        ]);
    }

    public function store($data = [])
    {
        $validator = new Validator;

        $color        = new Color;
        $selectColors = $color->select();

        $conditions      = new StampCondition;
        $selectCondition = $conditions->select();

        $country       = new Country;
        $selectCountry = $country->select();

        $theme       = new Theme;
        $selectTheme = $theme->select();

        $validator->field('name', $data['name'], "Titre du timbre")->required()->max(200);

        $validator->field('description', $data['description'], "Description du timbre")->required();

        $validator->field('year', $data['year'], "L'époque du timbre")
            ->required()->inRange(1900, date("Y"));

        $validator->field('tirage', $data['tirage'], "Nombre d'exemplaires imprimés")->required();

        $validator->field('width', $data['width'], "Largeur en cm")->required()->number();

        $validator->field('height', $data['height'], "Longueur en cm")->required()->number();

        $validator->field('stamp_condition_id', $data['stamp_condition_id'] ?? null, "L'état du timbre")->notSelected();

        $validator->field('theme_id', $data['theme_id'] ?? null, "Indique le theme")->notSelected();

        $validator->field('color_id', $data['color_id'] ?? null, "Indique Couleur principale")->notSelected();

        $validator->field('country_id', $data['country_id'] ?? null, "Indique Pay d'origine")->notSelected();

        if ($validator->isSuccess()) {
            $data["user_id"] = $_SESSION['user_id'];
            $stamp           = new Stamp;
            $insertStamp     = $stamp->insert($data);
            var_dump($insertStamp);

            if ($insertStamp) {
                // echo("je rentre dans conditions insert stamp");
                // die();
                $_SESSION['stampId'] = $insertStamp;
                return view::redirect('stamp/create-image');
            } else {
                return View::render('error', ['msg' => 'Impossible d\'envoyer le timbre.']);
            }

        } else {
            $errors = $validator->getErrors();
            return View::render('stamp/create', ['errors' => $errors, 'stamp' => $data, 'colors' => $selectColors, 'conditions' => $selectCondition, 'countries' => $selectCountry, 'themes' => $selectTheme]);
        }
    }

    public function createImage()
    {
        return View::render('stamp/create-image');
    }

    public function storeCreateImage($data = [])
    {
        $validator = new Validator;

        $validator->field('file_name', $_FILES['file_name'], "Image principale")
            ->checkFileUploaded('file_name')
            ->checkImageFormat('file_name')
            ->checkIfImage('file_name')
            ->checkFileSize('file_name');

        if ($_FILES['second_file']['error'] == 0) {
            $validator->field('second_file', $_FILES['second_file'], "Seconde image")
                ->checkFileUploaded('second_file')
                ->checkImageFormat('second_file')
                ->checkIfImage('second_file')
                ->checkFileSize('second_file');
        }

        if ($_FILES['third_file']['error'] == 0) {
            $validator->field('third_file', $_FILES['third_file'], "Troisième image")
                ->checkFileUploaded('third_file')
                ->checkImageFormat('third_file')
                ->checkIfImage('third_file')
                ->checkFileSize('third_file');
        }
        $idStampUser = $_SESSION['stampId'];

        if ($validator->isSuccess()) {

            $position = 0;

            $insertAllData = false;

            foreach ($data as $oneData) {

                if ($oneData != null) {
                    $oneDataStore                = [];
                    $oneDataStore["position"]    = $position;
                    $oneDataStore["description"] = $oneData;
                    $oneDataStore["stamp_id"]    = $idStampUser;
                    $oneDataStore["file_name"]   = "";

                    foreach ($_FILES as $oneFile => $fileInfos) {
                        if ($fileInfos["error"] === 0) {
                            $folderUpload = __DIR__ . '/../public/uploads/';
                            $targetedFile = $folderUpload . basename($fileInfos["name"]);
                            if (move_uploaded_file($fileInfos['temporal_name'], $targetedFile)) {
                                $oneDataStore["file_name"] = basename($fileInfos["name"]);
                            }
                        }
                    }

                    $ImageToUpload = new ImageToUpload;
                    $insertData    = $ImageToUpload->insert($oneDataStore);

                    if ($insertData) {
                        $insertAllData = true;

                    } else {
                        $insertAllData = false;
                    }
                    $position++;

                }
            }

            if ($insertAllData) {
                $_SESSION['stampId'] = null;
                return View::redirect('user/show');

            } else {
                return View::render('error', ['msg' => 'Les images n\'ont pas pu être chargées']);
            }

        } else {

            $errors = $validator->getErrors();
            return View::render('stamp/create-image', ['errors' => $errors, 'description' => $data]);
        }
    }

    public function index()
    {

        $stamp      = new Stamp;
        $color      = new Color;
        $conditions = new StampCondition;
        $country    = new Country;
        $theme      = new Theme;

        $fetchAllStamps = $stamp->fetchAllById($_SESSION['user_id'], "user_id", "id");

        foreach ($fetchAllStamps as $key => $oneStamp) {
            $colorName                        = $color->selectId($oneStamp["color_id"]);
            $fetchAllStamps[$key]["color_id"] = $colorName["color"];

            $conditionsName                             = $conditions->selectId($oneStamp["stamp_condition_id"]);
            $fetchAllStamps[$key]["stamp_condition_id"] = $colorName["stamp_condition"];

            $countryName                        = $country->selectId($oneStamp["country_id"]);
            $fetchAllStamps[$key]["country_id"] = $countryName["country"];

            $themeName                        = $theme->selectId($oneStamp["theme_id"]);
            $fetchAllStamps[$key]["theme_id"] = $themeName["theme"];
        }

        return View::render('stamp/index', ['AllStamp' => $fetchAllStamps]);
    }
}

// echo('<pre>');
// print_r($_FILES);
// echo('</pre>');
// die();
