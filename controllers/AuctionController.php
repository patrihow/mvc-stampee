<?php
namespace App\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Color;
use App\Models\Country;
use App\Models\ImageToUpload;
use App\Models\Stamp;
use App\Models\StampCondition;
use App\Models\Theme;
use App\Models\User;
use App\Providers\View;

class AuctionController
{
    public function home()
    {
        return View::render('auction/home');
    }

    public function index()
    {
        $auctionModel    = new Auction;
        $stampModel      = new Stamp;
        $imageModel      = new ImageToUpload;
        $conditionsModel = new StampCondition;
        $themeModel      = new Theme;
        $bidModel        = new Bid;
        $userModel       = new User;
        $colorModel      = new Color;
        $countryModel    = new Country;

        $auctions = $auctionModel->select();

        foreach ($auctions as $auctionsIndex => $auction) {
            $stampData                             = $stampModel->selectId($auction['stamp_id']);
            $auctions[$auctionsIndex]['stampName'] = $stampData['name'];
            $auctions[$auctionsIndex]['yearStamp'] = $stampData['year'];

            $stampConditionData                          = $conditionsModel->selectId($stampData['stamp_condition_id']);
            $auctions[$auctionsIndex]['stamp_condition'] = $stampConditionData["name"];

            $themeData                         = $themeModel->selectId($stampData['theme_id']);
            $auctions[$auctionsIndex]['theme'] = $themeData['name'];

            $highestBid = $bidModel->selectWhereIdMax("auction_id", $auction["id"], "bid_amount");

            if ($highestBid && ! empty($highestBid)) {
                $auctions[$auctionsIndex]['highestBid']        = $highestBid["bid_amount"];
                $highestBidderInfo                             = $userModel->selectIdWhere("id", $highestBid["user_id"]);
                $auctions[$auctionsIndex]['highestBidderName'] = $highestBidderInfo["name"];

            } else {
                $auctions[$auctionsIndex]['highestBid']        = "Pas de mise";
                $auctions[$auctionsIndex]['highestBidderName'] = "Aucun";
            }

            $stampImages = $imageModel->fetchAllById($auction['stamp_id'], "stamp_id");

            foreach ($stampImages as $stampImagesIndex => $image) {
                if ($image["position"] == 0) {
                    $auctions[$auctionsIndex]['file_name']   = $image['file_name'];
                    $auctions[$auctionsIndex]['description'] = $image['description_alt'];
                }
            }
        }

        $filterConditions = $conditionsModel->select();
        $filterCountry    = $countryModel->select();
        $filterColors     = $colorModel->select();
        return View::render('auction/catalog', ['auctions' => $auctions, 'conditions' => $filterConditions, 'countries' => $filterCountry, 'colors' => $filterColors]);

    }

    public function filter()
    {

        $auctionModel = new Auction;

        $auctions = $auctionModel->filter($_GET);

        $stampModel      = new Stamp;
        $imageModel      = new ImageToUpload;
        $conditionsModel = new StampCondition;
        $themeModel      = new Theme;
        $bidModel        = new Bid;
        $userModel       = new User;
        $colorModel      = new Color;
        $countryModel    = new Country;

    }
}
