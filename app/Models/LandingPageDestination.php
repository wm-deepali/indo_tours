<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageDestination extends Model
{
    protected $fillable = [
        'hero_heading',
        'hero_description',
        'hero_video',

        'destinations_heading',
        'destinations_description',

        'packages_heading',
        'packages_description',

        'why_travel_heading',
        'why_travel_description',
        'why_travel_items',

        'highlight_image',
        'highlight_tag',
        'highlight_heading',
        'highlight_description',
        'highlight_points',
        'highlight_cta_text',
        'highlight_cta_url',

        'experiences_heading',
        'experiences_description',
        'experience_items',

        'guides_heading',
        'guides_description',
        'guide_items',

        'faqs_heading',
        'faqs',
    ];

    protected $casts = [
        'why_travel_items' => 'array',
        'highlight_points' => 'array',
        'experience_items' => 'array',
        'guide_items' => 'array',
        'faqs' => 'array',
    ];
}