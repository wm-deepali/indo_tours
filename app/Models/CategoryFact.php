<?php

// app/Models/CategoryFact.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryFact extends Model
{
    protected $fillable = ['category_id', 'number', 'label', 'sort_order'];
}