<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionBudgetTier extends Model
{
    protected $fillable = [
        'attraction_id',
        'tier_name',
        'price_range',
        'price_unit',
        'note',
        'features',
        'is_recommended',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_recommended' => 'boolean',
    ];

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }
}