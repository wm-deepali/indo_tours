<?php
// app/Models/Activity.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    protected $fillable = [
        'activity_category_id',
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
        'featured',
        'sort_order',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'highlights' => 'array',
        'know_before_you_go' => 'array',
        'sidebar_points' => 'array',
        'map_points' => 'array',
        'rating' => 'float',
        'starting_price' => 'float',
        'review_count' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ActivityCategory::class, 'activity_category_id');
    }

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

    public function tourPackages(): BelongsToMany
    {
        return $this->belongsToMany(TourPackage::class, 'tour_package_activity')
            ->withPivot('sort_order');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable')->where('status', 'published');
    }

    public function attractions()
    {
        return $this->belongsToMany(Attraction::class, 'activity_attraction')
            ->withPivot('sort_order')
            ->orderBy('activity_attraction.sort_order');
    }

}