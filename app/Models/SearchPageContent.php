<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchPageContent extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_description',
        'hero_image',
        'usps',
    ];

    protected $casts = [
        'usps' => 'array',
    ];

    /** Always returns the single content row, creating sane defaults the first time. */
    public static function instance(): self
    {
        return static::first() ?? static::create([
            'hero_title' => 'Explore Trips That Match Your Search',
            'hero_description' => 'Discover handpicked tours and holiday packages based on your destination, travel style and preferences.',
            'usps' => [
                ['icon' => null, 'title' => 'Expertly Planned Trips', 'description' => 'Itineraries curated by travel specialists with on-ground destination knowledge.'],
                ['icon' => null, 'title' => 'Best Price Assistance', 'description' => 'Transparent pricing with no hidden costs, plus help finding the best available deal.'],
                ['icon' => null, 'title' => 'Dedicated Travel Support', 'description' => 'A real person to call before, during and after your trip — not a chatbot queue.'],
                ['icon' => null, 'title' => 'Flexible Customization', 'description' => "Tailor hotels, activities and duration to match exactly what you're looking for."],
            ],
        ]);
    }
}