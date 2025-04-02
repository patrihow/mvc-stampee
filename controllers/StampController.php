<?php
namespace App\Controllers;

use App\Models\Color;
use App\Models\Country;
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

    }

    public function createImage()
    {

    }

    public function storeCreateImage($data = [])
    {

    }
}
