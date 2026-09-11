<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Destination extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'country_id',
        'state_id',
        'city_id',
        'name',
        'slug',
        'image',
        'short_description',
        'description',
        'more_about_intro',
        'more_about_content',
        'verdict_title',
        'recommended_for',
        'why_visit_image',
        'why_visit_media_tag',
        'duration_text',
        'best_time_text',
        'budget_text',
        'best_for_tags',
        'is_featured',
        'season_highlights',
        'budget_intro_text',
        'budget_note',
        'sort_order',
        'status',
        'h1',
        'meta_title',
        'meta_description',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card_image',
        'robots',
    ];

    protected $casts = [
        'best_for_tags' => 'array',
        'is_featured' => 'boolean',
        'season_highlights' => 'array'
    ];

    // e.g. Destination::published()->get()
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Breadcrumb-style location string: "Srinagar, Jammu & Kashmir, India"
    public function getLocationTextAttribute(): string
    {
        return collect([
            $this->city?->name,
            $this->state?->name,
            $this->country?->name,
        ])->filter()->implode(', ');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function matches(): HasMany
    {
        return $this->hasMany(DestinationMatch::class)->orderBy('sort_order');
    }

    public function areas(): HasMany
    {
        return $this->hasMany(DestinationArea::class)->orderBy('sort_order');
    }

    public function highlights(): HasMany
    {
        return $this->hasMany(DestinationHighlight::class)->orderBy('sort_order');
    }

    public function places(): HasMany
    {
        return $this->hasMany(DestinationPlace::class)->orderBy('sort_order');
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

    public function galleries(): HasMany
    {
        return $this->hasMany(DestinationGallery::class)->orderBy('sort_order');
    }

    public function banner(): HasOne
    {
        return $this->hasOne(DestinationBanner::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(DestinationActivity::class)->orderBy('sort_order');
    }

    public function routes(): HasMany
    {
        return $this->hasMany(DestinationRoute::class)->orderBy('sort_order');
    }

    public function journeyDays(): HasMany
    {
        return $this->hasMany(DestinationJourneyDay::class)->orderBy('sort_order');
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(DestinationSeason::class)->orderBy('sort_order');
    }

    public function budgetTiers(): HasMany
    {
        return $this->hasMany(DestinationBudgetTier::class)->orderBy('sort_order');
    }

    public function budgetBreakdown(): HasMany
    {
        return $this->hasMany(DestinationBudgetBreakdown::class)->orderBy('sort_order');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(DestinationFaq::class)->orderBy('sort_order');
    }

    public function subCategoryLinks(): HasMany
    {
        return $this->hasMany(SubCategoryDestination::class);
    }
    
}