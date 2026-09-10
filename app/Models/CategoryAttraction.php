<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryAttraction extends Model
{
    protected $fillable = ['category_id', 'attraction_id', 'sort_order'];

    public function attraction(): BelongsTo
    {
        return $this->belongsTo(Attraction::class);
    }
}