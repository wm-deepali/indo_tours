<?php
// database/seeders/LandingPageActivitySeeder.php

namespace Database\Seeders;

use App\Models\LandingPageActivity;
use Illuminate\Database\Seeder;

class LandingPageActivitySeeder extends Seeder
{
    public function run(): void
    {
        $landingPage = LandingPageActivity::firstOrCreate([]);

        $landingPage->update([
            // ---- Hero Banner ----
            'hero_badge_text' => 'Exclusive Activity Deals',
            'hero_heading' => 'Best Activities & Experiences',
            'hero_description' => 'Discover unforgettable things to do, from desert adventures and luxury cruises to iconic attractions and thrilling experiences.',
            'hero_cta_text' => 'Explore Activities',
            'hero_cta_url' => '#indian-activities-grid',
            'hero_slider_images' => [], // upload real slides from the admin panel

            // ---- Intro ----
            'intro_heading' => 'Things to Do',
            'intro_description' => 'Explore top attractions, thrilling adventures, luxury experiences and unforgettable activities for every traveller.',

            // ---- Offer Promo ----
            'offer_badge_text' => 'Experience Sale',
            'offer_heading' => 'Save up to INR 10,000 on selected activities',
            'offer_description' => 'Book selected experiences and enjoy limited-time offers on unforgettable adventures.',
            'offer_cta_text' => 'Explore Deals',
            'offer_cta_url' => 'javascript:void()',
            'offer_countdown_end' => null, // set a real end date from the admin panel to show the countdown

            // ---- Group Offer Banner ----
            'group_offer_badge_text' => 'Special Offer',
            'group_offer_heading' => 'Make Your Trip More Exciting & Save More',
            'group_offer_description' => 'Enjoy special offers on activities, sightseeing, desert adventures, cruises and unforgettable experiences.',
            'group_offer_perks' => [
                'Save on Selected Activities',
                'Special Deals on Popular Experiences',
                'Easy Booking & Flexible Travel Options',
            ],
            'group_offer_cta1_text' => 'View Offers',
            'group_offer_cta1_url' => '#package-list',
            'group_offer_cta2_text' => 'Get A Quote',
            'group_offer_cta2_url' => 'javascript:void()',
            'group_offer_image' => null,

            // ---- Planning Guide ----
            'planning_eyebrow' => 'Plan Ahead',
            'planning_heading' => 'Plan Your Activities',
            'planning_blocks' => [
                [
                    'title' => 'Best Time for Outdoor Activities',
                    'content' => 'Outdoor experiences like desert safaris and water sports are most comfortable between November and March, when temperatures are cooler. Indoor attractions remain enjoyable year-round, including during the hot summer months.',
                ],
                [
                    'title' => 'Best Activities for Families',
                    'content' => 'Families often enjoy aquariums, theme parks, and a relaxed dhow cruise. These experiences suit a range of ages and require little physical exertion.',
                ],
                [
                    'title' => 'Best Activities for Couples',
                    'content' => 'Couples looking for a romantic experience tend to prefer a private yacht cruise, a dinner cruise, or an evening visit to an observation deck.',
                ],
                [
                    'title' => 'Adventure Activities',
                    'content' => 'Desert safari with dune bashing and a BBQ dinner, skydiving over the coastline, and jet skiing or other water sports.',
                ],
                [
                    'title' => 'Indoor Activities',
                    'content' => 'On hotter days, aquariums, indoor theme parks, and shopping mall attractions offer a comfortable way to keep exploring.',
                ],
                [
                    'title' => 'What to Know Before Booking',
                    'content' => 'Check pickup timings for tours, dress modestly for cultural sites, and confirm whether hotel transfers are included with your chosen activity before you book.',
                ],
            ],

            // ---- Why Book With Us ----
            'benefits_heading' => 'Why Book With Us?',
            'benefits_description' => 'Enjoy trusted activities, great prices, easy booking, and reliable support throughout your holiday.',
            'benefits_items' => [
                [
                    'icon' => 'star',
                    'title' => 'Handpicked Experiences',
                    'description' => 'Carefully selected experiences from trusted providers.',
                ],
                [
                    'icon' => 'clock',
                    'title' => 'Best Value',
                    'description' => 'Competitive prices and selected destination offers.',
                ],
                [
                    'icon' => 'check-circle',
                    'title' => 'Easy Enquiry',
                    'description' => 'Quick and simple activity enquiry process.',
                ],
                [
                    'icon' => 'shield',
                    'title' => 'Travel Support',
                    'description' => 'Assistance from travel experts.',
                ],
            ],

            // ---- Final CTA ----
            'final_cta_heading' => 'Ready to Start Your Adventure?',
            'final_cta_description' => 'Tell us what you want to experience and our travel experts will help you choose the right activity.',
            'final_cta1_text' => 'Talk to a Travel Expert',
            'final_cta1_url' => 'javascript:void(0)',
            'final_cta2_text' => 'Explore Tours',
            'final_cta2_url' => '/tours/',

            // ---- Related Destinations ----
            'related_destinations_heading' => 'Popular Related Destinations',
            'related_destinations_description' => 'Explore popular destinations and discover more places, experiences and things to do for your next holiday.',
            'related_destination_ids' => [], // pick real Attraction records from the admin panel

            // ---- SEO Links ----
            'seo_links_heading' => 'Explore More',
            'seo_links_description' => 'Discover popular tours, activities, places to visit and experiences to make your journey unforgettable.',
            'seo_link_blocks' => [
                [
                    'heading' => 'Popular Tours',
                    'links' => [
                        ['text' => 'Tour Packages', 'url' => '/tour-packages/'],
                        ['text' => 'Family Packages', 'url' => '/family-packages/'],
                        ['text' => 'Honeymoon Packages', 'url' => '/honeymoon-packages/'],
                        ['text' => 'Luxury Tours', 'url' => '/luxury-tours/'],
                        ['text' => 'Group Tours', 'url' => '/group-tours/'],
                    ],
                ],
                [
                    'heading' => 'Things to Do',
                    'links' => [
                        ['text' => 'Places to Visit', 'url' => '/places-to-visit/'],
                        ['text' => 'Best Time to Visit', 'url' => '/best-time-to-visit/'],
                        ['text' => 'Travel Guide', 'url' => '/travel-guide/'],
                        ['text' => 'Things to Do', 'url' => '/things-to-do/'],
                        ['text' => 'City Tours', 'url' => '/city-tour/'],
                    ],
                ],
                [
                    'heading' => 'Popular Activities',
                    'links' => [
                        ['text' => 'Desert Safari', 'url' => '/activities/desert-safari/'],
                        ['text' => 'Marina Cruise', 'url' => '/activities/marina-cruise/'],
                        ['text' => 'Water Sports', 'url' => '/activities/water-sports/'],
                        ['text' => 'Yacht Tour', 'url' => '/activities/yacht-tour/'],
                        ['text' => 'Theme Parks', 'url' => '/activities/theme-parks/'],
                    ],
                ],
                [
                    'heading' => 'Tour Packages From Popular Cities',
                    'links' => [
                        ['text' => 'From Delhi', 'url' => '/tour-packages/from-delhi/'],
                        ['text' => 'From Mumbai', 'url' => '/tour-packages/from-mumbai/'],
                        ['text' => 'From Bangalore', 'url' => '/tour-packages/from-bangalore/'],
                        ['text' => 'From Ahmedabad', 'url' => '/tour-packages/from-ahmedabad/'],
                        ['text' => 'From Hyderabad', 'url' => '/tour-packages/from-hyderabad/'],
                    ],
                ],
            ],
        ]);
    }
}