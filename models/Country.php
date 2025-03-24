<?php
namespace App\Models;

use App\Models\CRUD;

class Country extends CRUD
{
    protected $table      = 'country';
    protected $primaryKey = 'id';
}
