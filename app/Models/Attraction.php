<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attraction extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'about_image',
        'short_description',
        'description',
        'about_content',
        'about_more_title',
        'about_more_content',
        'offer_badge_text',
        'offer_title',
        'offer_description',
        'offer_perks',
        'offer_image',
        'offer_button_text',
        'offer_button_url',
        'duration_text',
        'best_time_text',
        'best_for_tags',
        'rating',
        'review_count',
        'is_featured',
        'status',
        'sort_order',
        'country_id',
        'state_id',
        'city_id',
        'map_location',
        'h1',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'promo_eyebrow',
        'promo_title',
        'promo_description',
        'promo_button_text',
        'promo_button_url'
    ];

    protected $casts = [
        'best_for_tags' => 'array',
        'is_featured' => 'boolean',
        'rating' => 'float',
        'offer_perks' => 'array',
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
        return $this->hasMany(AttractionGallery::class)->orderBy('sort_order');
    }

    public function highlights()
    {
        return $this->hasMany(AttractionHighlight::class)->orderBy('sort_order');
    }

    public function experiences()
    {
        return $this->hasMany(AttractionExperience::class)->orderBy('sort_order');
    }

    public function places()
    {
        return $this->hasMany(AttractionPlace::class)->orderBy('sort_order');
    }

    public function itineraries()
    {
        return $this->hasMany(AttractionItinerary::class)->orderBy('sort_order');
    }

    public function seasons()
    {
        return $this->hasMany(AttractionSeason::class)->orderBy('sort_order');
    }

    public function transports()
    {
        return $this->hasMany(AttractionTransport::class)->orderBy('sort_order');
    }

    public function budgetTiers()
    {
        return $this->hasMany(AttractionBudgetTier::class)->orderBy('sort_order');
    }

    public function carryGroups()
    {
        return $this->hasMany(AttractionCarryGroup::class)->orderBy('sort_order');
    }

    public function faqs()
    {
        return $this->hasMany(AttractionFaq::class)->orderBy('sort_order');
    }

    public function tourPackages(): BelongsToMany
    {
        return $this->belongsToMany(TourPackage::class, 'tour_package_attraction')
            ->withPivot('sort_order');
    }

}