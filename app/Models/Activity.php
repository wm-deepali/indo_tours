<?php
// app/Models/Activity.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'country_id',
        'state_id',
        'city_id',
        'location_label',
        'banner_tag',
        'banner_description',
        'main_image',
        'video_url',
        'banner_top_image',
        'banner_top_label',
        'banner_top_title',
        'banner_left_image',
        'banner_left_label',
        'banner_left_title',
        'banner_right_image',
        'banner_right_label',
        'banner_right_title',
        'duration_text',
        'free_cancellation_text',
        'rating',
        'review_count',
        'starting_price',
        'price_unit',
        'about_title',
        'about_content',
        'highlights',
        'what_to_expect_content',
        'know_before_you_go',
        'sidebar_points',
        'map_embed_url',
        'map_address',
        'map_points',
        'map_directions_url',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'highlights' => 'array',
        'know_before_you_go' => 'array',
        'sidebar_points' => 'array',
        'map_points' => 'array',
        'rating' => 'float',
        'starting_price' => 'float',
        'review_count' => 'integer',
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

    public function packages()
    {
        return $this->hasMany(ActivityPackage::class)->orderBy('sort_order');
    }

    public function faqs()
    {
        return $this->hasMany(ActivityFaq::class)->orderBy('sort_order');
    }

    public function policies()
    {
        return $this->hasMany(ActivityPolicy::class)->orderBy('sort_order');
    }
}