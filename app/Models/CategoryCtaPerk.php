<?php

// app/Models/CategoryCtaPerk.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryCtaPerk extends Model
{
    protected $fillable = ['category_id', 'text', 'sort_order'];
}