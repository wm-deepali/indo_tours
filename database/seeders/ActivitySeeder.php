<?php
// database/seeders/ActivitySeeder.php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\TourPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $country = Country::firstOrCreate(['name' => 'India']);
        $state = State::firstOrCreate(['name' => 'Jammu and Kashmir', 'country_id' => $country->id]);
        $city = City::firstOrCreate(['name' => 'Srinagar', 'state_id' => $state->id]);

        $activity = Activity::updateOrCreate(
            ['slug' => 'shikara-ride-dal-lake'],
            [
                'name' => 'Shikara Ride on Dal Lake',
                'country_id' => $country->id,
                'state_id' => $state->id,
                'city_id' => $city->id,
                'location_label' => 'Dal Lake, Srinagar, Kashmir',

                'banner_tag' => 'Explore Kashmir',
                'banner_description' => 'Glide across the tranquil waters of Dal Lake aboard a traditional Shikara and take in views of houseboats, floating gardens and the Zabarwan hills.',
                'main_image' => $this->copyDemoImage('assets/images/attraction/kashmir1.jpg', 'activity-main'),
                'video_url' => 'assets/video/trip.mp4',

                'banner_top_image' => $this->copyDemoImage('assets/images/attraction/kashmir2.jpg', 'activity-top'),
                'banner_top_label' => 'Floating Gardens',
                'banner_top_title' => 'Dal Lake Floating Gardens',

                'banner_left_image' => $this->copyDemoImage('assets/images/attraction/kashmir3.jpg', 'activity-left'),
                'banner_left_label' => 'Houseboats',
                'banner_left_title' => 'Traditional Kashmiri Houseboats',

                'banner_right_image' => $this->copyDemoImage('assets/images/attraction/kashmir4.jpg', 'activity-right'),
                'banner_right_label' => 'Sunset Views',
                'banner_right_title' => '360° Views of the Zabarwan Hills',

                'duration_text' => '1–2 hrs',
                'free_cancellation_text' => 'Free Cancellation',

                'rating' => 4.7,
                'review_count' => 210,
                'starting_price' => 899,
                'price_unit' => '/ Person',

                'about_title' => 'About Shikara Ride on Dal Lake',
                'about_content' => "Dal Lake is the crown jewel of Srinagar, and a Shikara ride is the classic way to experience it. Glide past colourful houseboats, floating vegetable markets and the famous Mughal gardens lining the shore, with the Zabarwan hills rising in the background. Your boatman shares stories of the lake's history and daily life on the water as you drift past centuries-old traditions still practised today.",

                'highlights' => [
                    'Glide past traditional houseboats and floating gardens on Dal Lake.',
                    'Take in panoramic views of the Zabarwan hills and Mughal-era shoreline gardens.',
                    'Catch a beautiful sunset from the water during the evening slot.',
                    'Learn about local Kashmiri lake life from your experienced boatman.',
                ],

                'what_to_expect_content' => "Your Shikara ride begins at one of Dal Lake's main ghats, where your boatman helps you aboard a traditional, cushioned Shikara. As you drift across the lake, you'll pass houseboats, floating gardens and local vendors selling flowers, saffron and handicrafts directly from their boats. The ride is calm and relaxed, ideal for photography, with stops possible near Nishat Bagh or Shalimar Bagh depending on your chosen route.",

                'know_before_you_go' => [
                    'Life jackets are provided and recommended for all passengers.',
                    'Sunset slots are the most popular — book in advance during peak season.',
                    'Wheelchair-accessible boats are available on request.',
                ],

                'sidebar_points' => [
                    'Instant confirmation',
                    'Mobile voucher accepted',
                    'Free cancellation up to 24 hrs',
                ],

                'map_embed_url' => 'https://www.google.com/maps?q=Dal%20Lake%20Srinagar&output=embed',
                'map_address' => 'Dal Lake, Srinagar, Jammu & Kashmir, India',
                'map_points' => [
                    'Nearest landmark: Nehru Park (5 min by boat)',
                    'Boarding points available at Ghat No. 1 through Ghat No. 9',
                ],
                'map_directions_url' => 'https://www.google.com/maps/dir/?api=1&destination=Dal+Lake+Srinagar',

                'status' => 'published',
                'sort_order' => 0,
            ]
        );

        // ---- Package Options ----
        // ⚠️ Assumed fields: title, duration_label, description, includes (array), old_price, price, save_text, sort_order
        $activity->packages()->delete();
        foreach ([
            [
                'title' => 'Shared Shikara Ride – 1 Hour',
                'duration_label' => 'Non-Prime Hours',
                'desc' => 'A relaxed 1-hour Shikara ride shared with other travellers, covering the main sights of Dal Lake.',
                'includes' => ['Life jacket included', 'Shared boat (up to 6 people)', 'Standard daytime route'],
                'old_price' => 1200,
                'price' => 899,
                'save_text' => 'Save 25%',
            ],
            [
                'title' => 'Private Shikara Ride – 1 Hour',
                'duration_label' => 'Prime Sunset Hours',
                'desc' => 'A private boat just for your group, with a guaranteed sunset time slot for the best lighting.',
                'includes' => ['Life jacket included', 'Private boat (up to 4 people)', 'Priority sunset slot'],
                'old_price' => 2000,
                'price' => 1699,
                'save_text' => 'Save 15%',
            ],
            [
                'title' => 'Shikara Ride + Houseboat Tea',
                'duration_label' => 'Non-Prime Hours',
                'desc' => 'A 1.5-hour ride that includes a stop at a traditional houseboat for a cup of authentic Kashmiri kahwa.',
                'includes' => ['Life jacket included', 'Private boat (up to 4 people)', 'Houseboat tea stop included'],
                'old_price' => 2600,
                'price' => 2199,
                'save_text' => 'Save 15%',
            ],
        ] as $i => $package) {
            $activity->packages()->create([
                'title' => $package['title'],
                'duration_label' => $package['duration_label'],
                'description' => $package['desc'],
                'includes' => $package['includes'],
                'old_price' => $package['old_price'],
                'new_price' => $package['price'],
                'save_text' => $package['save_text'],
                'sort_order' => $i,
            ]);
        }

        // ---- Policies (grouped like the Dubai page: title + bullet content) ----
        // ⚠️ Assumed fields: title, content (newline-separated bullets), sort_order
        $activity->policies()->delete();
        foreach ([
            [
                'title' => 'Cancellation Policy',
                'content' => "Free cancellation up to 24 hours before your scheduled slot.\nNo refund for cancellations made within 24 hours of the ride.",
            ],
            [
                'title' => 'Booking Confirmation',
                'content' => "Instant confirmation via email and SMS on successful booking.\nMobile voucher accepted — no printout required.",
            ],
            [
                'title' => 'Entry & Reporting Time',
                'content' => "Report at least 15 minutes prior to your selected time slot at the designated ghat.\nTickets are valid only for the date and time slot selected.",
            ],
            [
                'title' => 'Child & Family Information',
                'content' => "Suitable for all ages; children below 3 years ride free.\nLife jackets are available in child sizes on request.",
            ],
        ] as $i => $policy) {
            $activity->policies()->create([
                'title' => $policy['title'],
                'points' => $policy['content'],
                'sort_order' => $i,
            ]);
        }

        // ---- FAQs ----
        $activity->faqs()->delete();
        foreach ([
            ['q' => 'What is included in the Shikara ride ticket?', 'a' => 'A life jacket, a seat aboard a traditional cushioned Shikara, and a guided route across the main sights of Dal Lake.'],
            ['q' => 'How long is the ride?', 'a' => 'Most rides last between 1 and 1.5 hours depending on the package selected.'],
            ['q' => 'Where does the ride start?', 'a' => 'Boarding is available at several ghats around Dal Lake in Srinagar — your exact boarding point will be confirmed after booking.'],
            ['q' => 'Can I choose a sunset time slot?', 'a' => 'Yes, sunset slots are available and are the most popular choice — we recommend booking these in advance.'],
            ['q' => 'Is it suitable for families with young children?', 'a' => 'Yes, the ride is suitable for all ages, and life jackets are available in child sizes.'],
        ] as $i => $faq) {
            $activity->faqs()->create([
                'question' => $faq['q'],
                'answer' => $faq['a'],
                'sort_order' => $i,
            ]);
        }

        // ---- Attach this Activity to existing Tour Packages ----
        $tourPackages = TourPackage::all();
        foreach ($tourPackages as $tp) {
            $tp->activities()->syncWithoutDetaching([$activity->id => ['sort_order' => 0]]);
        }

        $this->command->info('Shikara Ride on Dal Lake activity seeded and attached to ' . $tourPackages->count() . ' tour package(s).');
    }

    private function copyDemoImage(string $publicRelativePath, string $label): ?string
    {
        $source = public_path($publicRelativePath);

        if (!File::exists($source)) {
            return null;
        }

        $destinationDir = storage_path('app/public/activities/demo');
        File::ensureDirectoryExists($destinationDir);

        $filename = $label . '-' . Str::random(6) . '.' . File::extension($source);
        File::copy($source, $destinationDir . '/' . $filename);

        return 'activities/demo/' . $filename;
    }
}