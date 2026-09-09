<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionItinerary extends Model
{
    protected $fillable = ['attraction_id', 'days', 'title', 'is_popular', 'sort_order'];

    protected $casts = [
        'is_popular' => 'boolean',
    ];

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }

    public function stops()
    {
        return $this->hasMany(AttractionItineraryStop::class)->orderBy('sort_order');
    }
}