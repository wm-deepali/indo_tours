<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPageContent extends Model
{
    protected $fillable = [
        'banner_heading', 'banner_description', 'banner_cta_text', 'banner_cta_url',
        'banner_video', 'banner_video_poster',

        'who_we_are_heading', 'who_we_are_description', 'stats',
        'content_card_title', 'content_card_description_1', 'content_card_description_2',
        'content_card_cta_text', 'content_card_cta_url', 'content_card_image',

        'why_choose_heading', 'why_choose_description', 'why_choose_items',

        'mission_heading', 'mission_description', 'mission_image_one', 'mission_image_two',
        'mission_features', 'mission_cta_text', 'mission_cta_url',

        'how_it_works_heading', 'how_it_works_description', 'how_it_works_steps',

        'philosophy_eyebrow', 'philosophy_heading', 'philosophy_heading_highlight',
        'philosophy_description', 'philosophy_cta_text', 'philosophy_cta_url', 'philosophy_image',

        'team_heading', 'team_description', 'team_members',

        'testimonials_heading', 'testimonials_description',

        'gallery_heading', 'gallery_description', 'gallery_items',

        'faq_heading', 'faqs',
    ];

    protected $casts = [
        'stats' => 'array',
        'why_choose_items' => 'array',
        'mission_features' => 'array',
        'how_it_works_steps' => 'array',
        'team_members' => 'array',
        'gallery_items' => 'array',
        'faqs' => 'array',
    ];

    /** Always returns the single content row, creating sane defaults the first time. */
    public static function instance(): self
    {
        return static::first() ?? static::create([
            'banner_heading' => 'Our Story',
            'banner_description' => 'We create thoughtfully planned trips and unforgettable travel experiences, helping you discover new destinations with comfort, confidence, and ease.',
            'banner_cta_text' => 'Explore Our Story',

            'who_we_are_heading' => 'Who We Are',
            'who_we_are_description' => 'We create personalized trips and unforgettable experiences, making every journey simple, seamless, and memorable.',
            'stats' => [
                ['icon' => null, 'count' => 45, 'suffix' => 'K+', 'label' => 'Happy campers'],
                ['icon' => null, 'count' => 1500, 'suffix' => '+', 'label' => 'Trips sold'],
                ['icon' => null, 'count' => 60, 'suffix' => 'K', 'label' => 'Destinations'],
                ['icon' => null, 'count' => 150, 'suffix' => '+', 'label' => 'Travel buddies'],
            ],
            'content_card_title' => 'We Make Every Journey Worth Remembering',
            'content_card_description_1' => 'We are passionate travel planners dedicated to creating memorable journeys that are simple, exciting, and hassle-free.',
            'content_card_description_2' => 'From handpicked destinations to thoughtfully planned itineraries, we help you discover new places and create experiences you\'ll cherish.',
            'content_card_cta_text' => 'Discover Our Story',

            'why_choose_heading' => 'Why Choose Us',
            'why_choose_description' => 'We make every journey simple, memorable, and tailored to you—from thoughtful planning to unforgettable experiences.',
            'why_choose_items' => [
                ['icon' => null, 'title' => 'Expertly Planned', 'description' => 'Every itinerary is designed with attention to detail.'],
                ['icon' => null, 'title' => 'Local Experiences', 'description' => 'Experience destinations beyond the usual tourist spots.'],
                ['icon' => null, 'title' => 'Best Value', 'description' => 'Great experiences at prices designed for real travelers.'],
                ['icon' => null, 'title' => '24/7 Support', 'description' => 'We\'re there whenever you need us during your journey.'],
                ['icon' => null, 'title' => 'Flexible Packages', 'description' => 'Choose packages that fit your travel style and budget.'],
                ['icon' => null, 'title' => 'Trusted Partners', 'description' => 'We work with reliable hotels, transport providers and local experts.'],
            ],

            'mission_heading' => 'Our Mission: Meaningful Travel.',
            'mission_description' => 'We believe travel is more than visiting new places. It is about discovering new experiences, creating lasting memories, and connecting with the people and places around us.',
            'mission_features' => [
                ['icon' => null, 'title' => 'Meaningful Experiences', 'description' => 'We focus on experiences that help you discover the true character of every destination.'],
                ['icon' => null, 'title' => 'Personalized Journeys', 'description' => 'Every traveler is different, so we create trips around your interests, pace, and preferences.'],
                ['icon' => null, 'title' => 'Thoughtful Planning', 'description' => 'From stays and activities to transportation, we take care of the details that make a trip run smoothly.'],
                ['icon' => null, 'title' => 'Travel With Confidence', 'description' => 'Our team is here to support you throughout your journey, whenever you need us.'],
            ],
            'mission_cta_text' => 'Plan Your Journey',

            'how_it_works_heading' => 'How It Works',
            'how_it_works_description' => 'We make every journey simple, memorable, and tailored to you—from thoughtful planning to unforgettable experiences.',
            'how_it_works_steps' => [
                ['color' => 'yellow', 'title' => 'Tell Us Your Plan', 'description' => 'Share your destination, dates, budget and travel preferences.'],
                ['color' => 'gray', 'title' => 'We Plan Your Trip', 'description' => 'Our travel experts create a personalized itinerary for you.'],
                ['color' => 'lavender', 'title' => 'Customize', 'description' => 'Modify hotels, activities, transportation and experiences.'],
                ['color' => 'green', 'title' => 'Confirm Your Trip', 'description' => 'Finalize your itinerary and booking.'],
                ['color' => 'peach', 'title' => 'Start Exploring', 'description' => 'Pack your bags and enjoy your journey.'],
            ],

            'philosophy_eyebrow' => 'Our Philosophy',
            'philosophy_heading' => 'We Don\'t Just Plan Trips.',
            'philosophy_heading_highlight' => 'We Create Experiences.',
            'philosophy_description' => 'We believe that travel should be an experience that enriches your life and creates lasting memories.',
            'philosophy_cta_text' => 'Plan Your Journey',

            'team_heading' => 'Meet The People Behind Your Journey',
            'team_description' => 'Our travel experts bring passion and experience together to create seamless, memorable journeys.',
            'team_members' => [],

            'testimonials_heading' => 'Clients Feedback About Us',
            'testimonials_description' => 'Are you tired of the typical tourist destinations and looking to step out of your comfort zone travel',

            'gallery_heading' => 'Moments From The Journey',
            'gallery_description' => 'A glimpse into the places, faces and adventures our travelers have captured along the way.',
            'gallery_items' => [],

            'faq_heading' => 'Get to Know Our Journey.',
            'faqs' => [],
        ]);
    }
}