<?php
namespace App\Models;

use App\Models\CRUD;

class ImageToUpload extends CRUD
{
    protected $table      = 'image_to_upload';
    protected $primaryKey = 'id';
    protected $fillable   = ['file_name', 'position', 'description_alt', 'stamp_id'];
}