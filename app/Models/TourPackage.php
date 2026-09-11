<?php
// app/Models/TourPackage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourPackage extends Model
{
    protected $fillable = [
        'sub_category_id', 'name', 'slug', 'status',
        'country_id', 'state_id', 'city_id',
        'banner_tag_text', 'banner_intro', 'main_image', 'top_image',
        'bottom_left_image', 'bottom_right_image', 'video_url',
        'duration_text', 'old_price', 'price', 'price_unit_text',
        'overview_title', 'overview_content', 'map_embed_url',
        'meta_title', 'meta_description', 'og_title', 'og_description', 'og_image', 'canonical_url',
    ];

    protected $casts = [
        'old_price' => 'decimal:2',
        'price' => 'decimal:2',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Breadcrumb-style: "Leh, Ladakh, India" — mirrors Destination::getLocationTextAttribute
    public function getLocationTextAttribute(): string
    {
        return collect([
            $this->city?->name,
            $this->state?->name,
            $this->country?->name,
        ])->filter()->implode(', ');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function features(): HasMany
    {
        return $this->hasMany(TourPackageFeature::class)->orderBy('sort_order');
    }

    public function durationOptions(): HasMany
    {
        return $this->hasMany(TourPackageDurationOption::class)->orderBy('sort_order');
    }

    public function routeStops(): HasMany
    {
        return $this->hasMany(TourPackageRouteStop::class)->orderBy('sort_order');
    }

    public function highlights(): HasMany
    {
        return $this->hasMany(TourPackageHighlight::class)->orderBy('sort_order');
    }

    public function itineraryDays(): HasMany
    {
        return $this->hasMany(TourPackageItineraryDay::class)->orderBy('sort_order');
    }

    public function hotelStays(): HasMany
    {
        return $this->hasMany(TourPackageHotelStay::class)->with('hotel.galleries')->orderBy('sort_order');
    }

    public function includes(): HasMany
    {
        return $this->hasMany(TourPackageInclude::class)->orderBy('sort_order');
    }

    public function excludes(): HasMany
    {
        return $this->hasMany(TourPackageExclude::class)->orderBy('sort_order');
    }

    public function policies(): HasMany
    {
        return $this->hasMany(TourPackagePolicy::class)->orderBy('sort_order');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(TourPackageFaq::class)->orderBy('sort_order');
    }
}