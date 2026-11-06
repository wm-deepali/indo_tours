<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    // If your existing Hotel model has extra things (SoftDeletes, accessors...), merge them in.
    protected $fillable = [
        'name', 'slug', 'country_id', 'state_id', 'city_id',
        'rating', 'star_rating', 'category',
        'check_in_time', 'check_out_time',
        'short_description', 'description', 'location', 'address',
        'facilities',
        'map_embed_url', 'map_directions_url', 'map_points',
        'h1', 'meta_title', 'meta_description', 'canonical_url', 'robots',
        'og_title', 'og_description', 'og_image', 'twitter_card_image',
        'status',
    ];

    protected $casts = [
        'facilities' => 'array',
        'map_points' => 'array',
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

    public function galleries()
    {
        return $this->hasMany(HotelGallery::class)->orderBy('sort_order');
    }

    public function rooms()
    {
        return $this->hasMany(HotelRoom::class)->orderBy('sort_order');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}