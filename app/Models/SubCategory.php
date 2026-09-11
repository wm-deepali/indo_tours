<?php
// app/Models/SubCategory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'status',
        'offer_tag_text',
        'h1',
        'intro_text',
        'banner_image_one',
        'banner_image_two',
        'button1_text',
        'button1_url',
        'button2_text',
        'button2_url',
        'heading_text',
        'heading_highlight',
        'heading_intro',
        'cta_badge_text',
        'cta_title',
        'cta_description',
        'cta_image',
        'cta_button_text',
        'cta_button_url',
        'cta_button2_text',
        'cta_button2_url',
        'promo_badge_text',
        'promo_title',
        'promo_description',
        'promo_button_text',
        'promo_button_url',
        'promo_end_at',
        'faq_heading',
        'faq_heading_highlight',
        'faq_intro',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
    ];

    protected $casts = [
        'promo_end_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function destinationLinks(): HasMany
    {
        return $this->hasMany(SubCategoryDestination::class)->orderBy('sort_order');
    }

    public function attractionLinks(): HasMany
    {
        return $this->hasMany(SubCategoryAttraction::class)->orderBy('sort_order');
    }

    public function highlights(): HasMany
    {
        return $this->hasMany(SubCategoryHighlight::class)->orderBy('sort_order');
    }

    public function ctaPerks(): HasMany
    {
        return $this->hasMany(SubCategoryCtaPerk::class)->orderBy('sort_order');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(SubCategoryFaq::class)->orderBy('sort_order');
    }

    public function tourPackages(): HasMany
    {
        return $this->hasMany(TourPackage::class);
    }

}