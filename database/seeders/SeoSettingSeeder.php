<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Seeder;

class SeoSettingSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            // Home
            ['page_key' => 'home', 'page_label' => 'Home'],

            // Tour Related — Listing Pages
            ['page_key' => 'tour_category_listing', 'page_label' => 'Category Listing Page'],
            ['page_key' => 'destination_listing', 'page_label' => 'Destination Page (Listing)'],
            ['page_key' => 'attraction_listing', 'page_label' => 'Attraction Page (Listing)'],
            ['page_key' => 'activities_listing', 'page_label' => 'Activities Page (Listing)'],

            // Profile Pages
            ['page_key' => 'about', 'page_label' => 'About Us'],
            ['page_key' => 'contact', 'page_label' => 'Contact Us'],
            ['page_key' => 'blog_listing', 'page_label' => 'Blog Listing'],
            ['page_key' => 'faq', 'page_label' => 'FAQ'],
            ['page_key' => 'feedback_reviews', 'page_label' => 'Feedback & Reviews'],

            // Legal Pages
            ['page_key' => 'terms_conditions', 'page_label' => 'Terms & Conditions'],
            ['page_key' => 'privacy_policy', 'page_label' => 'Privacy Policy'],
            ['page_key' => 'refunds_cancellations', 'page_label' => 'Refunds & Cancellations'],
            ['page_key' => 'cookies_policy', 'page_label' => 'Cookies Policy'],
            ['page_key' => 'disclaimer', 'page_label' => 'Disclaimer'],

            // Others
            ['page_key' => '404', 'page_label' => '404 Not Found'],
            ['page_key' => 'thank_you', 'page_label' => 'Thank You Page'],
            ['page_key' => 'search_result', 'page_label' => 'Search Result Page'],
        ];

        foreach ($pages as $page) {
            SeoSetting::firstOrCreate(['page_key' => $page['page_key']], $page);
        }
    }
}