<?php
namespace App\Models;

use App\Models\CRUD;

class Stamp extends CRUD
{
    protected $table      = 'stamp';
    protected $primaryKey = 'id';
    protected $fillable   = ['name', 'description', 'year', 'tirage', 'width', 'height', 'is_certified', 'stamp_condition_id', 'country_id', 'theme_id', 'color_id', 'user_id'];
}