<?php
namespace App\Models;

use App\Models\CRUD;

class Auction extends CRUD
{
    protected $table      = 'auction';
    protected $primaryKey = 'id';
    protected $fillable   = ['name', 'started_at', 'finish_at', 'starting_price', 'lord_favorite', 'stamp_id', 'state_id'];
}