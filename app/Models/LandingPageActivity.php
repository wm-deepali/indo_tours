<?php
// app/Models/LandingPageActivity.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageActivity extends Model
{
    protected $fillable = [
        'hero_slider_images',
        'hero_badge_text',
        'hero_heading',
        'hero_description',
        'hero_cta_text',
        'hero_cta_url',

        'intro_heading',
        'intro_description',

        'offer_badge_text',
        'offer_heading',
        'offer_description',
        'offer_cta_text',
        'offer_cta_url',
        'offer_countdown_end',

        'group_offer_badge_text',
        'group_offer_heading',
        'group_offer_description',
        'group_offer_perks',
        'group_offer_cta1_text',
        'group_offer_cta1_url',
        'group_offer_cta2_text',
        'group_offer_cta2_url',
        'group_offer_image',

        'planning_eyebrow',
        'planning_heading',
        'planning_blocks',

        'benefits_heading',
        'benefits_description',
        'benefits_items',

        'final_cta_heading',
        'final_cta_description',
        'final_cta1_text',
        'final_cta1_url',
        'final_cta2_text',
        'final_cta2_url',

        'related_destinations_heading',
        'related_destinations_description',
        'related_destination_ids',
        'seo_links_heading',
        'seo_links_description',
        'seo_link_blocks',
    ];

    protected $casts = [
        'hero_slider_images' => 'array',
        'group_offer_perks' => 'array',
        'planning_blocks' => 'array',
        'benefits_items' => 'array',
        'offer_countdown_end' => 'datetime',
        'related_destination_ids' => 'array',
        'seo_link_blocks' => 'array',
    ];
}