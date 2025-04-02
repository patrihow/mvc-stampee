<?php
namespace App\Controllers;

use App\Models\Color;
use App\Models\Country;
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

        echo('<pre>');
        print_r($_FILES);
        echo('</pre>');
        die();

    }
}
