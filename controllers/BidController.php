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
use App\Providers\Validator;
use App\Providers\View;

class BidController
{
    public function store($data = [])
    {
        $validator = new Validator;

        $validator->field('bid_amount', $data['bid'], "Bid input")->number();

        if (! empty($_SESSION)) {
            $auctionModel = new Auction;
            $stamp        = new Stamp;
            $imageModel   = new ImageToUpload;
            $conditions   = new StampCondition;
            $bidModel     = new Bid;
            $user         = new User;

            if ($validator->isSuccess()) {
                $auctionDetails = $auctionModel->selectId($data["id"]);
                $highestBid     = $bidModel->selectWhereIdMax("auction_id", $data["id"], "bid_amount");

                if ($data["bid_amount"] > $auctionDetails["starting_price"] && $data["bid_amount"] > $highestBid["bid_amount"]) {
                    $dataInsert               = [];
                    $dataInsert["bid_amount"] = $data["bid_amount"];
                    $dataInsert["auction_id"] = $data["id"];
                    $dataInsert["user_id"]    = $_SESSION['user_id'];

                    $insertBid = $bidModel->insert($dataInsert);
                    if ($insertBid) {
                        return View::redirect('auction');
                    } else {
                        return View::render('error', ['msg' => "Votre enchère n'a pas pu être enregistrée"]);
                    }
                } else {
                    return View::render('error', ['msg' => "Enchère trop basse"]);
                }
            } else {
                $auctions = $auctionModel->select();

                foreach ($auctions as $auctionsIndex => $auction) {
                    $stampData                                   = $stamp->selectID($auction['stamp_id']);
                    $auctions[$auctionsIndex]['stampName']       = $stampData['name'];
                    $auctions[$auctionsIndex]['yearStamp']       = $stampData['year'];
                    $stampConditionData                          = $conditions->selectID($stampData['stamp_condition_id']);
                    $auctions[$auctionsIndex]['stamp_condition'] = $stampConditionData["name"];

                    $highestBid = $bidModel->selectWhereIdMax("auction_id", $auction["id"], "bid_amount");
                    if ($highestBid && ! empty($highestBid)) {
                        $auctions[$auctionsIndex]['highestBid']        = $highestBid["bid_amount"];
                        $highestBidderInfo                             = $user->selectIdWhere("id", $highestBid["user_id"]);
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

                $errors = $validator->getErrors();
                return View::render('auction/catalog', ['errors' => $errors, 'bidData' => $data, 'auctions' => $auctions]);
            }
        } else {
            return View::redirect('login');
        }
    }

    public function storeShow($data = [])
    {
        $validator = new Validator;

        $validator->field('bid_amount', $data['bid'], "input bid")->number();

        if (! empty($_SESSION)) {
            $auctionModel  = new Auction;
            $stamp         = new Stamp;
            $ImageToUpload = new ImageToUpload;

            $bidModel = new Bid;
            $user     = new User;

            $color      = new Color;
            $conditions = new StampCondition;
            $country    = new Country;
            $theme      = new Theme;

            $get       = ! empty($get) ? $get : $_GET;
            $idAuction = $get["id"];

            if ($validator->isSuccess()) {
                $auctionDetails = $auctionModel->selectId($data["id"]);
                $highestBid     = $bidModel->selectWhereIdMax("auction_id", $data["id"], "bid_amount");

                // -- Voy aqui hay que hacer la condition if

            }

        }
    }
}

// echo('<pre>');
// print_r($_FILES);
// echo('</pre>');
// die();
