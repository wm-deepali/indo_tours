<?php
// app/Models/SubCategoryFaq.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryFaq extends Model
{
    protected $fillable = ['sub_category_id', 'question', 'answer', 'sort_order'];
}