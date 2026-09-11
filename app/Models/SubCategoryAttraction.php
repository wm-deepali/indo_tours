<?php
// app/Models/SubCategoryAttraction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategoryAttraction extends Model
{
    protected $fillable = ['sub_category_id', 'attraction_id', 'sort_order'];

    public function attraction(): BelongsTo
    {
        return $this->belongsTo(Attraction::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }
}