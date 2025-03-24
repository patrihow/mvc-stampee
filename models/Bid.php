<?php
namespace App\Models;

use App\Models\CRUD;

class Bid extends CRUD
{
    protected $table      = 'bid';
    protected $primaryKey = 'id';
    protected $fillable   = ['bid_amount', 'created_at', 'user_id', 'auction_id'];
}