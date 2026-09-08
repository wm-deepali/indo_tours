<?php
// app/Models/Attraction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    protected $fillable = [
        'name', 'slug', 'image', 'short_description', 'description',
        'duration_text', 'best_time_text', 'best_for_tags', 'rating',
        'review_count', 'is_featured', 'status', 'sort_order',
        'country_id', 'state_id', 'city_id',
        'h1', 'meta_title', 'meta_description', 'og_title',
        'og_description', 'og_image', 'canonical_url',
    ];

    protected $casts = [
        'best_for_tags' => 'array',
        'is_featured'   => 'boolean',
        'rating'        => 'float',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}