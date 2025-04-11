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
        $auctionModel    = new Auction();
        $stampModel      = new Stamp();
        $imageModel      = new ImageToUpload();
        $conditionsModel = new StampCondition();
        $bidModel        = new Bid();
        $userModel       = new User();

        $bannerAuctions = $auctionModel->selectByLimit("started_at", 4, "DESC");

        foreach ($bannerAuctions as $auctionsIndex => $auction) {
            $stampInfo = $stampModel->selectId($auction['stamp_id']);

            if ($stampInfo) {
                $bannerAuctions[$auctionsIndex]['stampName'] = $stampInfo['name'] ?? 'Nombre no disponible';

                $conditionInfo                               = $conditionsModel->selectId($stampInfo['stamp_condition_id']);
                $bannerAuctions[$auctionsIndex]['condition'] = $conditionInfo ? $conditionInfo["name"] : 'Condición no disponible';

                $highestBid = $bidModel->selectWhereIdMax("auction_id", $auction["id"], "bid_amount");
                if ($highestBid) {

                    $bannerAuctions[$auctionsIndex]['highestBid']    = (float) $highestBid["bid_amount"];
                    $bannerAuctions[$auctionsIndex]['maxBidderName'] = $userModel->selectIdWhere("id", $highestBid["user_id"])["name"] ?? "Anónimo";
                } else {
                    $bannerAuctions[$auctionsIndex]['highestBid']    = 0;
                    $bannerAuctions[$auctionsIndex]['maxBidderName'] = "Aucun(e)";
                }

                $bannerAuctions[$auctionsIndex]['minBid'] = (float) ($bannerAuctions[$auctionsIndex]['highestBid'] ? $bannerAuctions[$auctionsIndex]['highestBid'] + 1 : $auction['starting_price'] + 1);

                $dateNow                                    = date("Y-m-d H:i:s");
                $timeLeft                                   = $this->calculateTimeLeft($dateNow, $auction["finish_at"]);
                $bannerAuctions[$auctionsIndex]['timeLeft'] = $timeLeft;

                $stampImages = $imageModel->fetchAllById($auction['stamp_id'], "stamp_id");
                foreach ($stampImages as $image) {
                    if ($image["position"] == 0) {
                        $bannerAuctions[$auctionsIndex]['fileName'] = $image['file_name'] ?? 'Imagen no disponible';
                    }
                }
            }
        }

        return View::render('auction/home', ["bannerAuctions" => $bannerAuctions]);
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
            $themeData                                   = $themeModel->selectId($stampData['theme_id']);
            $auctions[$auctionsIndex]['theme']           = $themeData['name'];

            $highestBid = $bidModel->selectWhereIdMax("auction_id", $auction["id"], "bid_amount");
            if ($highestBid) {

                $auctions[$auctionsIndex]['highestBid']        = (float) $highestBid["bid_amount"];
                $highestBidderInfo                             = $userModel->selectIdWhere("id", $highestBid["user_id"]);
                $auctions[$auctionsIndex]['highestBidderName'] = $highestBidderInfo["name"];
            } else {
                $auctions[$auctionsIndex]['highestBid']        = 0;
                $auctions[$auctionsIndex]['highestBidderName'] = "Aucun";
            }

            $stampImages = $imageModel->fetchAllById($auction['stamp_id'], "stamp_id");
            foreach ($stampImages as $image) {
                if ($image["position"] == 0) {
                    $auctions[$auctionsIndex]['file_name']   = $image['file_name'];
                    $auctions[$auctionsIndex]['description'] = $image['description_alt'];
                }
            }
        }

        $filterConditions = $conditionsModel->select();
        $filterCountry    = $countryModel->select();
        $filterColors     = $colorModel->select();

        return View::render('auction/catalog', [
            'auctions'   => $auctions,
            'conditions' => $filterConditions,
            'countries'  => $filterCountry,
            'colors'     => $filterColors,
        ]);
    }

    public function show()
    {
        $get       = $_GET ?? [];
        $idAuction = $get["id"];

        $auctionModel    = new Auction;
        $stampModel      = new Stamp;
        $imageModel      = new ImageToUpload;
        $conditionsModel = new StampCondition;
        $colorModel      = new Color;
        $countryModel    = new Country;
        $bidModel        = new Bid;
        $userModel       = new User;

        $auction    = $auctionModel->selectId($idAuction);
        $highestBid = $bidModel->selectWhereIdMax("auction_id", $auction["id"], "bid_amount");

        if ($highestBid) {
            $auction['highestBid']        = (float) $highestBid["bid_amount"];
            $bidderInfo                   = $userModel->selectIdWhere("id", $highestBid["user_id"]);
            $auction['highestBidderName'] = $bidderInfo["name"];
        } else {
            $auction['highestBid']        = "Aucune mise";
            $auction['highestBidderName'] = "Aucun(e)";
        }

        $stampInfo                   = $stampModel->selectId($auction["stamp_id"]);
        $colorData                   = $colorModel->selectId($stampInfo["color_id"]);
        $stampInfo["colorName"]      = $colorData["name"];
        $userData                    = $userModel->selectId($stampInfo["user_id"]);
        $stampInfo["userName"]       = $userData["name"];
        $countryData                 = $countryModel->selectId($stampInfo["country_id"]);
        $stampInfo["countryName"]    = $countryData["name"];
        $conditionData               = $conditionsModel->selectId($stampInfo["stamp_condition_id"]);
        $stampInfo["conditionState"] = $conditionData["name"];

        $dateNowAuction      = date('Y-m-d H:i:s');
        $auction['timeLeft'] = $this->calculateTimeLeft($dateNowAuction, $auction["finish_at"]);

        $stampImages = $imageModel->fetchAllById($stampInfo["id"], "stamp_id");

        $bannerAuctions = $auctionModel->selectByLimit("started_at", 4, "DESC");
        foreach ($bannerAuctions as $auctionsIndex => $bannerAuction) {
            $stampBannerInfo                               = $stampModel->selectId($bannerAuction['stamp_id']);
            $bannerAuctions[$auctionsIndex]['nameStamp']   = $stampBannerInfo['name'];
            $bannerAuctions[$auctionsIndex]['dateRelease'] = $stampBannerInfo['year'];

            $conditionBanner                             = $conditionsModel->selectId($stampBannerInfo['stamp_condition_id']);
            $bannerAuctions[$auctionsIndex]['condition'] = $conditionBanner["name"];

            $highestBidBanner = $bidModel->selectWhereIdMax("auction_id", $bannerAuction["id"], "bid_amount");
            if ($highestBidBanner) {
                $bannerAuctions[$auctionsIndex]['highestBid']        = (float) $highestBidBanner["bid_amount"];
                $bidderBannerInfo                                    = $userModel->selectIdWhere("id", $highestBidBanner["user_id"]);
                $bannerAuctions[$auctionsIndex]['highestBidderName'] = $bidderBannerInfo["name"];
            } else {
                $bannerAuctions[$auctionsIndex]['highestBid']        = "Aucune mise";
                $bannerAuctions[$auctionsIndex]['highestBidderName'] = "Aucun(e)";
            }

            $bannerAuctions[$auctionsIndex]['timeLeft'] = $this->calculateTimeLeft($dateNowAuction, $bannerAuction["finish_at"]);

            $stampImagesBanner = $imageModel->fetchAllById($bannerAuction['stamp_id'], "stamp_id");
            foreach ($stampImagesBanner as $image) {
                if ($image["position"] == 0) {
                    $bannerAuctions[$auctionsIndex]['fileName']        = $image['file_name'];
                    $bannerAuctions[$auctionsIndex]['fileDescription'] = $image['description_alt'];
                }
            }
        }

        return View::render('auction/show', [
            "images"         => $stampImages,
            "auction"        => $auction,
            "stampInfo"      => $stampInfo,
            "bannerAuctions" => $bannerAuctions,
        ]);
    }

    private function calculateTimeLeft($dateNow, $finish_at)
    {
        $timestampNow    = strtotime($dateNow);
        $timestampFinish = strtotime($finish_at);

        $timeLeft = $timestampFinish - $timestampNow;

        if ($timeLeft < 0) {
            return "Enchère terminée";
        }

        $days    = floor($timeLeft / (60 * 60 * 24));
        $hours   = floor(($timeLeft % (60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($timeLeft % (60 * 60)) / 60);

        return "{$days} jours {$hours} heures {$minutes} minutes";
    }
}
