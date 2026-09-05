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
        'verdict_title',
        'recommended_for',
        'why_visit_image',
        'why_visit_media_tag',
        'duration_text',
        'best_time_text',
        'budget_text',
        'best_for_tags',
        'is_featured',
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
    ];

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

    public function banner(): HasOne
    {
        return $this->hasOne(DestinationBanner::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(DestinationActivity::class)->orderBy('sort_order');
    }
}