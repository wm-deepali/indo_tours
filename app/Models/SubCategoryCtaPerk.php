<?php
// app/Models/SubCategoryCtaPerk.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryCtaPerk extends Model
{
    protected $fillable = ['sub_category_id', 'text', 'sort_order'];
}