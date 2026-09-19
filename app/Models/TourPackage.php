<?php
// app/Models/TourPackage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourPackage extends Model
{
    protected $fillable = [
        'sub_category_id',
        'name',
        'slug',
        'status',
        'featured',
        'country_id',
        'state_id',
        'city_id',
        'banner_tag_text',
        'banner_intro',
        'main_image',
        'top_image',
        'bottom_left_image',
        'bottom_right_image',
        'video_url',
        'duration_text',
        'duration_days',
        'duration_nights',
        'old_price',
        'price',
        'price_unit_text',
        'rating',
        'review_count',
        'overview_title',
        'overview_content',
        'map_embed_url',
        'group_offer_badge_text',
        'group_offer_title',
        'group_offer_description',
        'group_offer_button1_text',
        'group_offer_button1_url',
        'group_offer_image',
        'promo_badge_text',
        'promo_title',
        'promo_description',
        'promo_button_text',
        'promo_button_url',
        'promo_end_at',

        'h1',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card_image',
        'canonical_url',
        'robots',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'old_price' => 'decimal:2',
        'price' => 'decimal:2',
        'rating' => 'float',
        'review_count' => 'integer',
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

    public function amenities()
    {
        return $this->belongsToMany(\App\Models\Amenity::class, 'amenity_tour_package')
            ->orderBy('amenities.sort_order');
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

    public function enquiries(): HasMany
    {
        return $this->hasMany(TourPackageEnquiry::class);
    }

    public function destinations(): BelongsToMany
    {
        return $this->belongsToMany(Destination::class, 'tour_package_destination')
            ->withPivot('sort_order')
            ->orderByPivot('sort_order');
    }

    public function attractions(): BelongsToMany
    {
        return $this->belongsToMany(Attraction::class, 'tour_package_attraction')
            ->withPivot('sort_order')
            ->orderByPivot('sort_order');
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'tour_package_activity')
            ->withPivot('sort_order')
            ->orderByPivot('sort_order');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable')->where('status', 'published');
    }

    public function refreshRating(): void
    {
        $stats = $this->reviews()->selectRaw('COUNT(*) as c, AVG(rating) as a')->first();

        $this->forceFill([
            'review_count' => (int) $stats->c,
            'rating' => $stats->c ? round($stats->a, 1) : null,
        ])->saveQuietly();
    }
}