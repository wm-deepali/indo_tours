<?php

namespace Database\Seeders;

use App\Models\LandingPageAttraction;
use Illuminate\Database\Seeder;

class LandingPageAttractionSeeder extends Seeder
{
    /**
     * Seeds the singleton row with the original hardcoded copy from
     * attractions.blade.php, so the page reads the same as before
     * once it goes fully dynamic.
     */
    public function run(): void
    {
        LandingPageAttraction::updateOrCreate([], [
            // Hero
            'hero_heading' => 'Find Your Perfect Attraction',
            'hero_description' => 'Search for places, experiences and attractions to make your next trip unforgettable.',

            // Destinations grid
            'destinations_heading' => 'Explore Attractions by Destination',
            'destinations_description' => 'Find amazing places to visit across popular destinations and start planning your perfect journey.',

            // Featured Attractions
            'featured_heading' => 'Featured Attractions',
            'featured_description' => 'Explore some of the most popular places and experiences recommended for your next journey.',
            
            // Must-Visit
            'must_visit_heading' => 'Must-Visit Attractions',
            'must_visit_description' => 'Add these unforgettable places to your travel wishlist and make your next trip truly special.',

            // Promo banner
            'promo_eyebrow' => 'Plan Your Trip',
            'promo_heading' => "Can't Decide Where to Go?",
            'promo_description' => "Tell us what kind of experience you're looking for, and we'll help you plan a trip around the places you want to explore.",
            'promo_primary_text' => 'Plan My Trip',
            'promo_primary_url' => null,
            'promo_secondary_text' => 'Explore Tour Packages',
            'promo_secondary_url' => null,

            // Travel Guides
            'guides_heading' => 'Travel Inspiration & Guides',
            'guides_description' => 'Get useful travel tips, destination guides and inspiration to help you plan your next adventure.',
            'guide_items' => [
                [
                    'image' => null,
                    'category' => 'Kashmir',
                    'title' => 'Best Places to Visit in Kashmir',
                    'description' => 'Discover the most beautiful destinations and experiences to add to your Kashmir itinerary.',
                    'link_url' => '',
                ],
                [
                    'image' => null,
                    'category' => 'Goa',
                    'title' => 'Top Things to Do in Goa',
                    'description' => 'From beaches and water activities to local experiences, discover what makes Goa special.',
                    'link_url' => '',
                ],
                [
                    'image' => null,
                    'category' => 'Rajasthan',
                    'title' => 'Complete Rajasthan Travel Guide',
                    'description' => 'Explore royal cities, historic forts, cultural experiences and unforgettable destinations.',
                    'link_url' => '',
                ],
                [
                    'image' => null,
                    'category' => 'Manali',
                    'title' => 'Best Places to Visit in Manali',
                    'description' => 'Explore scenic mountains, adventure activities and peaceful escapes for your next Manali trip.',
                    'link_url' => '',
                ],
            ],

            // FAQs
            'faqs_heading' => 'Frequently Asked Questions',
            'faqs' => [
                [
                    'question' => 'What is an attraction?',
                    'answer' => 'An attraction is a place, landmark, natural site, cultural location or experience that travellers can visit and enjoy during their journey.',
                ],
                [
                    'question' => 'Can I include attractions in my tour package?',
                    'answer' => 'Yes. You can discuss your preferred attractions with our travel team and create an itinerary based on your travel requirements.',
                ],
                [
                    'question' => 'Can I create a customised trip?',
                    'answer' => 'Yes. Our team can help you plan a customised journey based on your destination, travel dates, interests and requirements.',
                ],
                [
                    'question' => 'How do I find attractions for a destination?',
                    'answer' => 'Use the search and destination filters above to explore attractions by location or category.',
                ],
                [
                    'question' => 'Can I visit multiple attractions in one trip?',
                    'answer' => 'Yes. Multiple attractions can be included in your itinerary depending on your travel duration, destination and preferred experiences.',
                ],
            ],
        ]);
    }
}