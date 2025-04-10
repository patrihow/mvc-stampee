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

        $validator->field('bid_amount', $data['bid_amount'], "Bid input")->number();

        if (! empty($_SESSION)) {
            $auctionModel    = new Auction;
            $stampModel      = new Stamp;
            $imageModel      = new ImageToUpload;
            $conditionsModel = new StampCondition;

            $bidModel  = new Bid;
            $userModel = new User;

            if ($validator->isSuccess()) {
                $auctionDetails = $auctionModel->selectId($data["auction_id"]);
                $highestBid     = $bidModel->selectWhereIdMax("auction_id", $data["auction_id"], "bid_amount");

                if ($data["bid_amount"] > $auctionDetails["starting_price"] && $data["bid_amount"] > ($highestBid ? $highestBid["bid_amount"] : 0)) {
                    $dataInsert = [
                        "bid_amount" => $data["bid_amount"],
                        "auction_id" => $data["auction_id"],
                        "user_id"    => $_SESSION['user_id'],
                        "created_at" => date('Y-m-d H:i:s'),
                    ];

                    if ($bidModel->insert($dataInsert)) {
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
                    $stampData                                   = $stampModel->selectId($auction['stamp_id']);
                    $auctions[$auctionsIndex]['stampName']       = $stampData['name'];
                    $auctions[$auctionsIndex]['yearStamp']       = $stampData['year'];
                    $stampConditionData                          = $conditionsModel->selectId($stampData['stamp_condition_id']);
                    $auctions[$auctionsIndex]['stamp_condition'] = $stampConditionData["name"];

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

                $errors = $validator->getErrors();
                return View::render('auction/catalog', [
                    'errors'   => $errors,
                    'bidData'  => $data,
                    'auctions' => $auctions,

                ]);
            }
        } else {
            return View::redirect('login');
        }
    }

    public function storeShow($data = [])
{
    
    $validator = new Validator;
    
    $validator->field('bid', $data['bid'], "Champ d'enchère")->number();

    
    if (!empty($_SESSION)) {
        
        $auctionModel = new Auction;
        $stampModel = new Stamp;
        $imageModel = new ImageToUpload;
        $conditionsModel = new StampCondition;
        $colorModel = new Color;
        $countryModel = new Country;
        $bidModel = new Bid;
        $userModel = new User;

       
        $get = !empty($_GET) ? $_GET : [];
        $idAuction = $get["id"];

       
        if ($validator->isSuccess()) {
            
            $auctionDetails = $auctionModel->selectId($data["id"]);
            $highestBid = $bidModel->selectWhereIdMax("auction_id", $data["id"], "bid");

            
            if ($data["bid"] > $auctionDetails["starting_price"] && ($highestBid ? $data["bid"] > $highestBid["bid"] : true)) {
                $dataInsert = [
                    "bid_amount" => $data["bid"],
                    "auction_id" => $data["id"],
                    "user_id" => $_SESSION['user_id'],
                    "created_at" => date('Y-m-d H:i:s'),
                ];

                if ($bidModel->insert($dataInsert)) {
                    return View::redirect('auction');
                } else {
                    return View::render('error', ['msg' => "Offre non reçue"]);
                }
            } else {
                return View::render('error', ['msg' => "Votre offre est inférieure au prix actuel"]);
            }
        } else {
            
            $errors = $validator->getErrors();
            return View::render('auction/catalog', ['errors' => $errors, 'bidData' => $data]);
        }
    } else {
        return View::redirect('login');
    }
}
}
