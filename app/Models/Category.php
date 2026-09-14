<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'menu_name',
        'slug',
        'sub_title',
        'heading',
        'short_description',
        'detail_content',
        'image',
        'status',
        'cta_title',
        'cta_badge_text',
        'cta_description',
        'cta_button_text',
        'cta_button_url',
        'cta_button2_text',
        'cta_button2_url',
        'cta_image',
        'listing_eyebrow',
        'listing_heading',
        'listing_heading_highlight',
        'listing_intro',
        'listing_button_text',
        'listing_button_url',
        'listing_button2_text',
        'listing_button2_url',
        'promo_badge_text',
        'promo_title',
        'promo_description',
        'promo_button_text',
        'promo_button_url',
        'promo_end_at',
        'plan_heading',
        'plan_heading_highlight',
        'plan_intro',
        'h1',
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

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function facts()
    {
        return $this->hasMany(CategoryFact::class)->orderBy('sort_order');
    }

    public function ctaPerks()
    {
        return $this->hasMany(CategoryCtaPerk::class)->orderBy('sort_order');
    }

    public function faqs()
    {
        return $this->hasMany(CategoryFaq::class)->orderBy('sort_order');
    }

}