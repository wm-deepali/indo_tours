<?php
// app/Models/SubCategoryHighlight.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryHighlight extends Model
{
    protected $fillable = ['sub_category_id', 'icon_image', 'title', 'value', 'sort_order'];
}