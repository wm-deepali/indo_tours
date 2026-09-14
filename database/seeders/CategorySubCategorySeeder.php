<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class CategorySubCategorySeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::firstOrCreate(
            ['slug' => 'family-tour-packages'],
            [
                'name' => 'Family Tour Packages',
                'menu_name' => 'Family Tours',
                'sub_title' => 'Trips Designed for Every Generation',
                'heading' => 'Family Tour Packages',
                'short_description' => 'Curated multi-day trips built for families travelling together — kid-friendly stays, flexible itineraries, and activities for every age group.',
                'detail_content' => 'Our Family Tour Packages are designed around comfort, safety, and shared experiences. Each itinerary balances sightseeing with downtime, uses family-friendly accommodations, and includes activities suitable for children and grandparents alike.',
                'image' => 'categories/family-tour-packages.jpg',
                'status' => 'published',

                'cta_title' => 'Ready to Plan Your Family Trip?',
                'cta_badge_text' => 'Family Special',
                'cta_description' => 'Get a customized family itinerary with flexible pacing and group discounts.',
                'cta_button_text' => 'Get a Custom Quote',
                'cta_button2_text' => 'Talk to an Expert',
                'cta_image' => 'categories/family-tour-packages-cta.jpg',

                'listing_eyebrow' => 'Family Travel',
                'listing_heading' => 'Explore Our',
                'listing_heading_highlight' => 'Family Tour Packages',
                'listing_intro' => 'From hill stations to beach getaways, browse packages designed with families in mind.',
                'listing_button_text' => 'View All Packages',

                'promo_badge_text' => 'Limited-Time Offer',
                'promo_title' => 'Save up to 20% on Family Bookings This Season',
                'promo_description' => 'Book a family package before the season ends and save on group rates.',
                'promo_button_text' => 'Know More',
                'promo_end_at' => now()->addMonths(2),

                'plan_heading' => 'Plan Your',
                'plan_heading_highlight' => 'Family Getaway',
                'plan_intro' => 'Not sure where to start? Here is how to plan the perfect family trip with us.',

                'h1' => 'Family Tour Packages',
                'meta_title' => 'Family Tour Packages | Book Family-Friendly Trips',
                'meta_description' => 'Browse curated family tour packages with kid-friendly stays, flexible pacing, and activities for all ages.',
                'og_title' => 'Family Tour Packages',
                'og_description' => 'Curated multi-day trips designed for families travelling together.',
                'og_image' => 'categories/family-tour-packages-og.jpg',
                'canonical_url' => url('/category/family-tour-packages'),
            ]
        );

        SubCategory::firstOrCreate(
            ['slug' => 'ladakh-family-package'],
            [
                'category_id' => $category->id,
                'name' => 'Ladakh Family Package',
                'status' => 'published',
                'offer_tag_text' => 'Family Special',
                'h1' => 'Ladakh Family Package',
                'intro_text' => 'Explore the majestic landscapes of Ladakh on a family-friendly itinerary — comfortable stays, easy pacing, and experiences for every age.',
                'banner_image_one' => 'subcategories/ladakh-family-banner1.jpg',
                'banner_image_two' => 'subcategories/ladakh-family-banner2.jpg',
                'button1_text' => 'View Packages',
                'button2_text' => 'Enquire Now',

                'heading_text' => 'Family Trips to',
                'heading_highlight' => 'Ladakh',
                'heading_intro' => 'Handpicked itineraries with family rooms, relaxed sightseeing, and kid-friendly activities across Leh, Nubra Valley and Pangong Tso.',

                'cta_badge_text' => 'Family Special',
                'cta_title' => 'Plan Your Ladakh Family Trip',
                'cta_description' => 'Get a custom quote tailored to your family size and travel dates.',
                'cta_image' => 'subcategories/ladakh-family-cta.jpg',
                'cta_button_text' => 'Get a Custom Quote',
                'cta_button2_text' => 'Talk to an Expert',

                'promo_badge_text' => 'Limited-Time Offer',
                'promo_title' => 'Save up to 15% on Ladakh Family Bookings',
                'promo_description' => 'Book before the season ends and save on group and family rates.',
                'promo_button_text' => 'Know More',
                'promo_end_at' => now()->addMonths(2),

                'faq_heading' => 'Frequently Asked',
                'faq_heading_highlight' => 'Questions',
                'faq_intro' => 'Everything families ask before booking a Ladakh trip.',

                'meta_title' => 'Ladakh Family Package | Family Tour Packages',
                'meta_description' => 'Book a family-friendly Ladakh tour package with comfortable stays, relaxed pacing, and activities suited for all ages.',
                'og_title' => 'Ladakh Family Package',
                'og_description' => 'Family-friendly trips to Ladakh — comfortable stays and relaxed itineraries.',
                'og_image' => 'subcategories/ladakh-family-og.jpg',
                'canonical_url' => url('/family-tour-packages/ladakh-family-package'),
            ]
        );

        $this->command->info('Family Tour Packages category + Ladakh Family Package subcategory seeded.');
    }
}