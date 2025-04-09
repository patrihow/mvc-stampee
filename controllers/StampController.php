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

        $currentYear = date('Y');
        $years       = range(1900, $currentYear);

        // var_dump($selectColors);
        return View::render('stamp/create', [
            'colors'     => $selectColors,
            'conditions' => $selectCondition,
            'countries'  => $selectCountry,
            'themes'     => $selectTheme,
            'years'      => $years,
        ]);
    }

    public function store($data = [])
    {
        $validator = new Validator;

        $validator->field('name', $data['name'], "Titre du timbre")->required()->max(200);
        $validator->field('description', $data['description'], "Description du timbre")->required();

        $year = (int) $data['year'];
        $validator->field('year', $year, "L'époque du timbre")->required()->inRange(1900, date("Y"));

        $validator->field('tirage', $data['tirage'], "Nombre d'exemplaires imprimés")->required();
        $validator->field('width', $data['width'], "Largeur en cm")->required()->number();
        $validator->field('height', $data['height'], "Longueur en cm")->required()->number();
        $validator->field('stamp_condition_id', $data['stamp_condition_id'] ?? null, "L'état du timbre")->notSelected();
        $validator->field('theme_id', $data['theme_id'] ?? null, "Indique le theme")->notSelected();
        $validator->field('color_id', $data['color_id'] ?? null, "Indique Couleur principale")->notSelected();
        $validator->field('country_id', $data['country_id'] ?? null, "Indique Pay d'origine")->notSelected();

        if ($validator->isSuccess()) {
            $data["user_id"]      = $_SESSION['user_id'];
            $data["is_certified"] = 0;
            $data["year"]         = $year;

            $stamp       = new Stamp;
            $insertStamp = $stamp->insert($data);

            if ($insertStamp) {
                $_SESSION['stampId'] = $insertStamp;
                return view::redirect('stamp/create-image');
            } else {
                return View::render('error', ['msg' => 'Impossible d\'envoyer le timbre.']);
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('stamp/create', ['errors' => $errors, 'stamp' => $data]);
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
        

        $validator->field('description_alt', $data['description_alt'], "La description de l'image principale")
            ->required()
            ->min(5)
            ->max(100);

        if ($_FILES['second_file']['error'] == 0) {
            $validator->field('second_file', $_FILES['second_file'], "La seconde image")
                ->checkFileUploaded('second_file')
                ->checkImageFormat('second_file')
                ->checkIfImage('second_file')
                ->checkFileSize('second_file');
            

            $validator->field('second_description', $data['second_description'], "La description de la seconde image")
                ->required()
                ->min(5)
                ->max(100);
        }

        if ($_FILES['third_file']['error'] == 0) {
            $validator->field('third_file', $_FILES['third_file'], "La troisième image")
                ->checkFileUploaded('third_file')
                ->checkImageFormat('third_file')
                ->checkIfImage('third_file')
                ->checkFileSize('third_file');
            

            $validator->field('third_description', $data['third_description'], "La description de la troisième image")
                ->required()
                ->min(5)
                ->max(100);
        }
        $idStampUser = $_SESSION['stampId'];

        if ($validator->isSuccess()) {
            $idStampUser = $_SESSION['stampId'];  
            $folderUpload = __DIR__ . '/../public/uploads/'; 
            
            $mainImageData = [
                "position" => 0,
                "description" => null, 
                "description_alt" => $data['description_alt'],
                "stamp_id" => $idStampUser,
                "file_name" => "",
            ];
            
            if (isset($_FILES['file_name']) && $_FILES['file_name']['error'] === 0) {
                $mainImageData["description"] = $data['description_alt'];
                $mainImageData["file_name"] = basename($_FILES['file_name']['name']);
                move_uploaded_file($_FILES['file_name']['tmp_name'], $folderUpload . $mainImageData["file_name"]);
                
                $ImageToUpload = new ImageToUpload;
                $ImageToUpload->insert($mainImageData);
            }
        
            if (isset($_FILES['second_file']) && $_FILES['second_file']['error'] === 0) {
                $secondImageData = [
                    "position" => 1,
                    "description" => $data['second_description'],
                    "description_alt" => '',
                    "stamp_id" => $idStampUser,
                    "file_name" => basename($_FILES['second_file']['name']),
                ];
                move_uploaded_file($_FILES['second_file']['tmp_name'], $folderUpload . $secondImageData["file_name"]);
                
                $ImageToUpload->insert($secondImageData);
            }
        
            if (isset($_FILES['third_file']) && $_FILES['third_file']['error'] === 0) {
                $thirdImageData = [
                    "position" => 2,
                    "description" => $data['third_description'],
                    "description_alt" => '',
                    "stamp_id" => $idStampUser,
                    "file_name" => basename($_FILES['third_file']['name']),
                ];
                move_uploaded_file($_FILES['third_file']['tmp_name'], $folderUpload . $thirdImageData["file_name"]);
                
                $ImageToUpload->insert($thirdImageData);
            }
        
            $_SESSION['stampId'] = null; 
            return View::redirect('stamp/index'); 
            
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
            $fetchAllStamps[$key]["color_id"] = $colorName["name"];

            $conditionsName                             = $conditions->selectId($oneStamp["stamp_condition_id"]);
            $fetchAllStamps[$key]["stamp_condition_id"] = $conditionsName["name"];

            $countryName                        = $country->selectId($oneStamp["country_id"]);
            $fetchAllStamps[$key]["country_id"] = $countryName["name"];

            $themeName                        = $theme->selectId($oneStamp["theme_id"]);
            $fetchAllStamps[$key]["theme_id"] = $themeName["name"];
        }

        return View::render('stamp/index', ['AllStamp' => $fetchAllStamps]);
    }

    public function edit()
    {
        $get     = $_GET;
        $idStamp = $get["id"];

        $color        = new Color;
        $selectColors = $color->select();

        $conditions      = new StampCondition;
        $selectCondition = $conditions->select();

        $country       = new Country;
        $selectCountry = $country->select();

        $theme       = new Theme;
        $selectTheme = $theme->select();

        $stamp       = new Stamp;
        $selectStamp = $stamp->selectID($idStamp);

        if ($_SESSION["user_id"] != $selectStamp["user_id"]) {
            return View::render('error', ['msg' => "Vous n'avez pas accès à ce timbre"]);
        }

        return View::render('stamp/edit', [
            'stamp'      => $selectStamp,
            'colors'     => $selectColors,
            'conditions' => $selectCondition,
            'countries'  => $selectCountry,
            'themes'     => $selectTheme,
        ]);
    }

    public function update($data = [])
    {
        $get     = $_GET;
        $idStamp = $get["id"];

        $stamp       = new Stamp;
        $selectStamp = $stamp->selectID($idStamp);

        if ($_SESSION["user_id"] != $selectStamp["user_id"]) {
            return View::render('error', ['msg' => "Vous n'avez pas accès à ce timbre."]);
        }

        $validator = new Validator;

        $validator->field('name', $data['name'], "Titre du timbre")->required()->max(200);
        $validator->field('description', $data['description'], "Description du timbre")->required();
        $validator->field('year', $data['year'], "L'époque du timbre")->required()->inRange(1900, date("Y"));
        $validator->field('tirage', $data['tirage'], "Nombre d'exemplaires imprimés")->required();
        $validator->field('width', $data['width'], "Largeur en cm")->required()->number();
        $validator->field('height', $data['height'], "Longueur en cm")->required()->number();
        $validator->field('stamp_condition_id', $data['stamp_condition_id'] ?? null, "L'état du timbre")->notSelected();
        $validator->field('theme_id', $data['theme_id'] ?? null, "Indique le theme")->notSelected();
        $validator->field('color_id', $data['color_id'] ?? null, "Indique Couleur principale")->notSelected();
        $validator->field('country_id', $data['country_id'] ?? null, "Indique Pay d'origine")->notSelected();

        if ($validator->isSuccess()) {
            $data["user_id"] = $_SESSION['user_id'];
            $updateStamp     = $stamp->update($data, $idStamp);

            if ($updateStamp) {
                $_SESSION['stampId'] = $idStamp;
                return View::redirect('stamp/create-image');
            } else {
                return View::render('error', ['msg' => 'L\'image n\'a pas pu être envoyée']);
            }
        } else {

            $errors = $validator->getErrors();
            return View::render('stamp/create', ['errors' => $errors, 'stamp' => $data]);
        }
    }
}

// echo('<pre>');
// print_r($_FILES);
// echo('</pre>');
// die();
