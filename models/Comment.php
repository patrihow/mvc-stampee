<?php
namespace App\Models;

use App\Models\CRUD;

class Comment extends CRUD
{
    protected $table      = 'comment';
    protected $primaryKey = 'id';
    protected $fillable   = ['comment_text', 'created_at', 'updated_at', 'user_id', 'auction_id'];
}