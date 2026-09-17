<?php

namespace Database\Seeders;

use App\Models\LandingPageDestination;
use Illuminate\Database\Seeder;

class LandingPageDestinationSeeder extends Seeder
{
    public function run(): void
    {
        $landingPage = LandingPageDestination::firstOrCreate([]);

        $landingPage->update([
            'hero_heading' => 'Find Your Perfect Destination',
            'hero_description' => 'Explore amazing destinations and discover tour packages designed around your travel style, interests, and budget.',

            'destinations_heading' => 'Popular Destinations',
            'destinations_description' => 'Explore some of the most loved destinations and start planning your next adventure.',

            'packages_heading' => 'Explore Our Tour Packages',
            'packages_description' => 'Discover carefully planned tour packages designed to make your journey comfortable, memorable and hassle-free.',

            'why_travel_heading' => 'Travel Made Simple',
            'why_travel_description' => 'We take care of the details so you can focus on enjoying your journey.',
            'why_travel_items' => [
                [
                    'icon' => 'star',
                    'title' => 'Personalized Itineraries',
                    'description' => 'Trips planned around your interests, travel style and schedule.',
                ],
                [
                    'icon' => 'shield',
                    'title' => 'Carefully Selected Packages',
                    'description' => 'Thoughtfully designed packages with great destinations and experiences.',
                ],
                [
                    'icon' => 'headset',
                    'title' => 'Trusted Travel Support',
                    'description' => 'Reliable assistance before and throughout your journey.',
                ],
                [
                    'icon' => 'clock',
                    'title' => 'Hassle-Free Planning',
                    'description' => 'From planning to experiences, we make your travel simple and stress-free.',
                ],
            ],

            'highlight_tag' => 'Destination Highlights',
            'highlight_heading' => 'Discover More, Experience More',
            'highlight_description' => 'Every destination has its own story. Explore local attractions, hidden gems, cultural experiences and unforgettable places worth adding to your itinerary.',
            'highlight_points' => [
                'Must-visit attractions',
                'Local experiences',
                'Best places to explore',
                'Things to do',
            ],
            'highlight_cta_text' => 'Explore Attractions',
            'highlight_cta_url' => null,

            'experiences_heading' => "Experiences You'll Love",
            'experiences_description' => 'From breathtaking landscapes to unforgettable adventures, discover experiences that make every destination special.',
            'experience_items' => [
                ['image' => null, 'title' => 'Adventure', 'description' => 'Trekking, rafting and thrilling outdoor activities.', 'link_url' => null],
                ['image' => null, 'title' => 'Beaches', 'description' => 'Coastlines, water sports and relaxing shores.', 'link_url' => null],
                ['image' => null, 'title' => 'Mountains', 'description' => 'Scenic valleys and peaceful Himalayan escapes.', 'link_url' => null],
                ['image' => null, 'title' => 'Heritage & Culture', 'description' => 'Iconic monuments, forts and local traditions.', 'link_url' => null],
                ['image' => null, 'title' => 'Wildlife', 'description' => 'National parks, safaris and nature reserves.', 'link_url' => null],
                ['image' => null, 'title' => 'Family Experiences', 'description' => 'Comfortable stays and activities for everyone.', 'link_url' => null],
            ],

            'guides_heading' => 'Travel Inspiration & Guides',
            'guides_description' => 'Get useful travel tips, destination guides and inspiration to help you plan your next adventure.',
            'guide_items' => [
                [
                    'image' => null,
                    'category' => 'Destination Guide',
                    'title' => 'Best Places to Visit in Kashmir',
                    'description' => 'Discover the most beautiful destinations and experiences to add to your Kashmir itinerary.',
                    'link_url' => null,
                ],
                [
                    'image' => null,
                    'category' => 'Travel Tips',
                    'title' => 'Top Things to Do in Goa',
                    'description' => 'From beaches and water activities to local experiences, discover what makes Goa special.',
                    'link_url' => null,
                ],
                [
                    'image' => null,
                    'category' => 'Destination Guide',
                    'title' => 'Complete Rajasthan Travel Guide',
                    'description' => 'Explore royal cities, historic forts, cultural experiences and unforgettable destinations.',
                    'link_url' => null,
                ],
            ],

            'faqs_heading' => 'Frequently Asked Questions',
            'faqs' => [
                [
                    'question' => 'What types of tour packages do you offer?',
                    'answer' => 'We offer a variety of travel packages including family holidays, honeymoon trips, adventure tours, weekend getaways and customized vacations.',
                ],
                [
                    'question' => 'Can I customize a tour package?',
                    'answer' => 'Yes. Our team can help create a customized itinerary based on your destination, travel dates, interests and requirements.',
                ],
                [
                    'question' => 'Can I choose specific attractions for my trip?',
                    'answer' => 'Yes. You can discuss your preferred attractions and experiences with our travel team while planning your itinerary.',
                ],
                [
                    'question' => 'What is included in a tour package?',
                    'answer' => 'Package inclusions vary by trip and may include accommodation, transportation, sightseeing, activities and other travel services. Check the individual package details for complete information.',
                ],
                [
                    'question' => 'How can I book a package?',
                    'answer' => 'You can explore the available packages and contact our travel team to discuss availability, requirements and booking options.',
                ],
                [
                    'question' => 'Do you provide support during the trip?',
                    'answer' => 'Yes. Our team is available to assist you with travel-related questions and support throughout your journey.',
                ],
            ],
        ]);
    }
}