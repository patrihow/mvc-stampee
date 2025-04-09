<?php
namespace App\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\ImageToUpload;
use App\Models\Stamp;
use App\Models\StampCondition;
use App\Models\User;
use App\Providers\Validator;
use App\Providers\View;

class BidController
{
    public function store($data = [])
    {
        $validator = new Validator;
        $validator->field('bid', $data['bid'], "Bid input")->number();

        if (! empty($_SESSION)) {
            $objAuction        = new Auction;
            $objStamp          = new Stamp;
            $objImageToUpload  = new ImageToUpload;
            $obtStampCondition = new StampCondition;
            $objBid            = new Bid;
            $objUser           = new User;

            if ($validator->isSuccess()) {
                $auctionDetails = $objAuction->selectId($data["id"]);
                $highestBid     = $objBid->selectWhereIdMax("auction_id", $data["id"], "bid");

                if ($data["bid"] > $auctionDetails["starting_price"] && $data["bid"] > $highestBid["bid"]) {
                    $dataInsert               = [];
                    $dataInsert["bid"]        = $data["bid"];
                    $dataInsert["auction_id"] = $data["id"];
                    $dataInsert["user_id"]    = $_SESSION['user_id'];

                    $insertBid = $objBid->insert($dataInsert);
                    if ($insertBid) {
                        return View::redirect('auction');
                    } else {
                        return View::render('error', ['msg' => "Votre enchère n'a pas pu être enregistrée"]);
                    }
                } else {
                    return View::render('error', ['msg' => "Enchère trop basse"]);
                }
            } else {
                $auctions = $objAuction->select();

                foreach ($auctions as $auctionsIndex => $auction) {
                    $stampData                                   = $objStamp->selectID($auction['stamp_id']);
                    $auctions[$auctionsIndex]['stampName']       = $stampData['name'];
                    $auctions[$auctionsIndex]['yearStamp']       = $stampData['year'];
                    $stampConditionData                          = $obtStampCondition->selectID($stampData['stamp_condition_id']);
                    $auctions[$auctionsIndex]['stamp_condition'] = $stampConditionData["name"];

                    $highestBid = $objBid->selectWhereIdMax("auction_id", $auction["id"], "bid");
                    if ($highestBid && ! empty($highestBid)) {
                        $auctions[$auctionsIndex]['highestBid']        = $highestBid["bid"];
                        $highestBidderInfo                             = $objUser->selectIdWhere("id", $highestBid["user_id"]);
                        $auctions[$auctionsIndex]['highestBidderName'] = $highestBidderInfo["name"];
                    } else {
                        $auctions[$auctionsIndex]['highestBid']        = "Pas de mise";
                        $auctions[$auctionsIndex]['highestBidderName'] = "Aucun";
                    }

                    $stampImages = $objImageToUpload->fetchAllById($auction['stamp_id'], "stamp_id");
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
        $validator->field('bid', $data['bid'], "input bid")->number(); // TODO: change to French! -- P'tit break :) I'm here
    }
}
