<?php
namespace App\Controllers;

use App\Models\Auction;
use App\Models\Color;
use App\Models\ImageToUpload;
use App\Models\Stamp;
use App\Models\StampCondition;
use App\Models\Country;
use App\Models\Theme;
use App\Providers\View;

class AuctionController
{
    public function home()
    {
        return View::render('auction/home');
    }

    public function index()
    {
        $objAuction = new Auction;
        $auctions   = $objAuction->select();

        $objStamp          = new Stamp;
        $objImageToUpload  = new ImageToUpload;
        $obtStampCondition = new StampCondition;
        $objColor          = new Color;
        $objCountry = new Country;
        $objTheme = new Theme;

        $year = isset($_GET["year"]);

        foreach ($auctions as $auctionsIndex => $auction) {

            $stampData = $objStamp->selectID(value: $auction['stamp_id']);
            $auctions[$auctionsIndex]['stampName'] = $stampData['name'];
            $auctions[$auctionsIndex]['yearStamp'] = $stampData['year'];

            $stampConditionData = $obtStampCondition->selectID($stampData['stamp_condition_id']);

            $auctions[$auctionsIndex]['stamp_condition'] = $stampConditionData["name"];

            $stampImages = $objImageToUpload->selectID($auction['stamp_id'], whereField: "stamp_id");

            foreach ($stampImages as $stampImagesIndex => $image) {
                if ($image["position"] == 0) {
                    $auctions[$auctionsIndex]['fileName'] = $image['file_name'];
                    $auctions[$auctionsIndex]['fileName'] = $image['description_alt'];
                }
            }
        }
        return View::render(template: 'auction/catalog', data: ['auctions' => $auctions]);

    }
}
