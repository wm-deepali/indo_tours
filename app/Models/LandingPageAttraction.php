<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageAttraction extends Model
{
    protected $fillable = [
        'hero_heading',
        'hero_description',
        'hero_video',

        'destinations_heading',
        'destinations_description',

        'featured_heading',
        'featured_description',

        'must_visit_heading',
        'must_visit_description',

        'promo_eyebrow',
        'promo_heading',
        'promo_description',
        'promo_image',
        'promo_primary_text',
        'promo_primary_url',
        'promo_secondary_text',
        'promo_secondary_url',

        'guides_heading',
        'guides_description',
        'guide_items',

        'faqs_heading',
        'faqs',
    ];

    protected $casts = [
        'guide_items' => 'array',
        'faqs' => 'array',
    ];
}