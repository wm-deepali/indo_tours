<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionSeason extends Model
{
    protected $fillable = [
        'attraction_id',
        'months',
        'title',
        'description',
        'tags',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
    ];

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }
}