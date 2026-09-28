<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{
    protected $fillable = [
        'hero_eyebrow', 'hero_heading', 'hero_description', 'hero_person_image', 'hero_illustration_image',

        'promo_eyebrow', 'promo_heading', 'promo_cta_text', 'promo_cta_url', 'promo_image',
        'promo_script_line_1', 'promo_script_line_2',

        'group_offer_badge_text', 'group_offer_heading', 'group_offer_description', 'group_offer_perks',
        'group_offer_cta1_text', 'group_offer_cta1_url', 'group_offer_cta2_text', 'group_offer_cta2_url',
        'group_offer_image',

        'who_we_are_badge', 'who_we_are_heading', 'who_we_are_heading_highlight', 'who_we_are_description',
        'who_we_are_image', 'who_we_are_stats', 'who_we_are_cta_text', 'who_we_are_cta_url',

        'home_slider_images',

        'testimonials_heading', 'testimonials_description',

        'discount_strip_eyebrow', 'discount_strip_percent', 'discount_strip_label',
        'discount_strip_cta_text', 'discount_strip_cta_url', 'discount_strip_bg_image', 'discount_strip_side_image',

        'support_heading', 'support_heading_highlight', 'support_description', 'support_image', 'support_items',

        'newsletter_eyebrow', 'newsletter_heading', 'newsletter_cta_text', 'newsletter_phone_image',
    ];

    protected $casts = [
        'group_offer_perks' => 'array',
        'who_we_are_stats' => 'array',
        'home_slider_images' => 'array',
        'support_items' => 'array',
    ];

    /** Always returns the single content row, creating sane defaults the first time. */
    public static function instance(): self
    {
        return static::first() ?? static::create([
            'hero_eyebrow' => 'Plan Smarter. Travel Better.',
            'hero_heading' => 'Your Perfect Trip, Planned in Minutes',
            'hero_description' => 'Create personalized travel itineraries, discover the best destinations, manage your schedule, and enjoy a seamless journey from start to finish.',

            'promo_eyebrow' => 'Enjoy Summer Deals',
            'promo_heading' => 'Up to 40% Discount!',
            'promo_cta_text' => 'See Details',
            'promo_script_line_1' => "Let's Discover",
            'promo_script_line_2' => 'The Whole World!',

            'group_offer_badge_text' => 'Limited-Time Offer',
            'group_offer_heading' => "Can't Decide? Get Up to 40% Off on Any Package You Choose",
            'group_offer_description' => 'Every package on this page qualifies for early-booking discounts, free transfers and flexible date changes — offer ends soon.',
            'group_offer_perks' => [
                'Early Bird Discount up to 40% Off',
                'Free Transfers on All Packages',
                'Free Cancellation Up to 15 Days Before Travel',
            ],
            'group_offer_cta1_text' => 'View Offers',
            'group_offer_cta1_url' => '#package-list',
            'group_offer_cta2_text' => 'Get A Quote',

            'who_we_are_badge' => 'Who we are',
            'who_we_are_heading' => 'Here Is Great Opportunity For',
            'who_we_are_heading_highlight' => 'Adventure & Travels',
            'who_we_are_description' => 'Dorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the Lorem ipsum dolor sit amet consectetur adipiscing elit.',
            'who_we_are_stats' => [
                ['icon' => null, 'count' => '5,000+', 'label' => 'Top Destination'],
                ['icon' => null, 'count' => '3,000+', 'label' => 'Booking Completed'],
                ['icon' => null, 'count' => '11,000+', 'label' => 'Satisfied Clients'],
            ],
            'who_we_are_cta_text' => 'More About Us',

            'home_slider_images' => [],

            'testimonials_heading' => 'Clients Feedback About Us',
            'testimonials_description' => 'Are you tired of the typical tourist destinations and looking to step out of your comfort zone travel',

            'discount_strip_eyebrow' => 'Travel Feni',
            'discount_strip_percent' => '25%',
            'discount_strip_label' => 'Extra Discount',
            'discount_strip_cta_text' => 'Book Now',

            'support_heading' => "When Something Unexpected Happens,",
            'support_heading_highlight' => "We're There",
            'support_description' => 'On-ground teams and real humans supporting you, before, during, and after your trip. Help when it truly matters.',
            'support_items' => [
                ['icon' => null, 'title' => 'Human Support, Not Ticket Numbers', 'description' => "You're assisted by real people who understand your booking — not automated replies or disconnected vendors."],
                ['icon' => null, 'title' => 'On-Ground Teams in Every City', 'description' => 'Local coordinators are on standby at your destination, ready to step in the moment plans change.'],
                ['icon' => null, 'title' => 'Always-On Response Time', 'description' => 'Flight delays, missed connections, sudden changes — our team is reachable around the clock, every day of your trip.'],
                ['icon' => null, 'title' => 'Trip Continuity, Not Just Refunds', 'description' => 'We focus on getting your trip back on track — rebooking, rerouting and fixing the plan, not just processing a refund.'],
            ],

            'newsletter_eyebrow' => 'Stay Updated',
            'newsletter_heading' => 'Get Trip Deals & Travel Tips Straight To Your Inbox!',
            'newsletter_cta_text' => 'Join Now',
        ]);
    }
}