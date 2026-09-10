<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/CategoryFaq.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryFaq extends Model
{
    protected $fillable = ['category_id', 'question', 'answer', 'sort_order'];
}