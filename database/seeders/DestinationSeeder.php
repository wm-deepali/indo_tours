<?php
// database/seeders/DestinationSeeder.php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Destination;
use App\Models\State;
use App\Models\TourPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $country = Country::firstOrCreate(['name' => 'India']);
        $state = State::firstOrCreate(['name' => 'Jammu and Kashmir', 'country_id' => $country->id]);
        $city = City::firstOrCreate(['name' => 'Srinagar', 'state_id' => $state->id]);

        $destination = Destination::updateOrCreate(
            ['slug' => 'kashmir'],
            [
                'country_id' => $country->id,
                'state_id' => $state->id,
                'city_id' => $city->id,
                'name' => 'Kashmir',
                'image' => $this->copyDemoImage('assets/images/attraction/kashmir1.jpg', 'kashmir-main'),

                'short_description' => 'A Himalayan escape of peaceful lakes, lush valleys, snow-covered mountains and unforgettable local experiences.',
                'description' => "A Himalayan escape of peaceful lakes, lush valleys, snow-covered mountains and unforgettable local experiences. From the serene waters of Dal Lake to the meadows of Gulmarg and Pahalgam, Kashmir offers a beautiful mix of nature, adventure, culture and relaxation.",

                'more_about_intro' => 'Plan Your Kashmir Holiday',
                'more_about_content' => "Kashmir is known for its beautiful valleys, peaceful lakes, mountain landscapes and memorable travel experiences. Explore our Kashmir Tour Packages to find itineraries for different trip durations and travel styles.",

                'verdict_title' => 'Is Kashmir right for you?',
                'recommended_for' => 'First-time visitors, couples, families and nature lovers.',

                'why_visit_image' => $this->copyDemoImage('assets/images/attraction/kashmir2.jpg', 'kashmir-why-visit'),
                'why_visit_media_tag' => 'Dal Lake, Srinagar',

                'duration_text' => '5–7 Days',
                'best_time_text' => 'March – October',
                'budget_text' => '₹25K – ₹60K+',
                'best_for_tags' => ['Couples', 'Families', 'Nature', 'Adventure'],

                'is_featured' => true,

                'season_highlights' => [
                    ['label' => 'Best overall', 'value' => 'March – October'],
                    ['label' => 'Best for snow', 'value' => 'December – February'],
                ],

                'budget_intro_text' => 'Estimated per-person budget for a 7-day trip',
                'budget_note' => null,

                'sort_order' => 0,
                'status' => 'published',

                'h1' => 'Kashmir',
                'meta_title' => 'Kashmir Tour Packages | Indo Tours & Adventures',
                'meta_description' => 'Explore Kashmir with curated tour packages covering Srinagar, Gulmarg, Pahalgam and Sonamarg — nature, adventure and relaxation in one trip.',
                'canonical_url' => url('/destinations/kashmir'),
                'og_title' => 'Kashmir | Indo Tours & Adventures',
                'og_description' => 'A Himalayan escape of peaceful lakes, lush valleys and snow-covered mountains.',
                'og_image' => $this->copyDemoImage('assets/images/attraction/kashmir1.jpg', 'kashmir-og'),
                'twitter_card_image' => $this->copyDemoImage('assets/images/attraction/kashmir1.jpg', 'kashmir-twitter'),
                'robots' => 'index, follow',
            ]
        );

        // ---- Gallery (banner grid images) ----
        // ⚠️ Assumed fields: image, title, subtitle, sort_order
        $destination->galleries()->delete();
        foreach ([
            ['image' => 'assets/images/attraction/kashmir1.jpg', 'title' => 'Dal Lake', 'subtitle' => 'Srinagar, Kashmir'],
            ['image' => 'assets/images/attraction/kashmir2.jpg', 'title' => 'Gulmarg', 'subtitle' => 'Kashmir'],
            ['image' => 'assets/images/attraction/kashmir3.jpg', 'title' => 'Pahalgam', 'subtitle' => 'Kashmir'],
            ['image' => 'assets/images/attraction/kashmir4.jpg', 'title' => 'Sonamarg', 'subtitle' => 'Kashmir'],
            ['image' => 'assets/images/attraction/kashmir5.jpg', 'title' => 'More Attractions', 'subtitle' => '14+'],
        ] as $i => $gallery) {
            $destination->galleries()->create([
                'image' => $this->copyDemoImage($gallery['image'], 'gallery-' . $i),
                'title' => $gallery['title'],
                'subtitle' => $gallery['subtitle'],
                'sort_order' => $i,
            ]);
        }

        // ---- Banner (hasOne) ----
        // ⚠️ Assumed fields: rating, review_count, more_count_label, more_count_text
        $destination->banner()->delete();
        $destination->banner()->create([
            'badge_text' => 'Limited-Time Offer',
            'heading' => 'Book Your Trip Early — Save Up to 40%',
            'description' => 'Grab early-booking discounts, seasonal deals and free add-on experiences before this offer ends.',
        ]);

        // ---- Matches ("Is Kashmir right for you?") ----
        // ⚠️ Assumed fields: want_text, icon, offer_text, sort_order
        $destination->matches()->delete();
        foreach ([
            ['want' => 'Mountains', 'icon' => 'assets/icon/mount.png', 'offer_text' => 'Himalayan valleys and panoramic viewpoints across the region.'],
            ['want' => 'Snow', 'icon' => 'assets/icon/snow.png', 'offer_text' => "Gulmarg's winter slopes, popular for skiing and snow play."],
            ['want' => 'Relaxation', 'icon' => 'assets/icon/relax.png', 'offer_text' => 'Lakes, houseboats and peaceful stays away from the city noise.'],
            ['want' => 'Adventure', 'icon' => 'assets/icon/adventures.png', 'offer_text' => 'Gondola rides, skiing and outdoor activities depending on the season.'],
            ['want' => 'Romance', 'icon' => 'assets/icon/heart.png', 'offer_text' => 'Scenic stays and a traditional Shikara ride across Dal Lake.'],
            ['want' => 'Family travel', 'icon' => 'assets/icon/family.png', 'offer_text' => 'Easy sightseeing and nature experiences suited to all ages.'],
        ] as $i => $match) {
            $destination->matches()->create([
                'want' => $match['want'],
                'icon' => $match['icon'],
                'offer_text' => $match['offer_text'],
                'sort_order' => $i,
            ]);
        }

        // ---- Stay Areas ----
        // ⚠️ Assumed fields: name, image, tag_text, stay_duration, why_text, nearby_text, is_default_open, sort_order
        $destination->areas()->delete();
        foreach ([
            ['name' => 'Srinagar', 'image' => 'assets/images/attraction/kashmir1.jpg', 'tag' => 'Best for first-time visitors', 'stay' => '2–3 Nights', 'why' => 'Best base for Dal Lake, Mughal Gardens, markets and starting your Kashmir journey.', 'nearby' => 'Dal Lake · Nishat Bagh · Shalimar Bagh', 'open' => true],
            ['name' => 'Gulmarg', 'image' => 'assets/images/attraction/kashmir2.jpg', 'tag' => 'Best for snow & adventure', 'stay' => '1–2 Nights', 'why' => 'Ideal for skiing, Gondola rides, mountain views and winter experiences.', 'nearby' => 'Gulmarg Gondola · Ski Slopes · Meadows', 'open' => false],
            ['name' => 'Pahalgam', 'image' => 'assets/images/attraction/kashmir4.jpg', 'tag' => 'Best for nature & relaxation', 'stay' => '1–2 Nights', 'why' => 'A peaceful base surrounded by valleys, forests and rivers.', 'nearby' => 'Betaab Valley · Aru Valley · Lidder River', 'open' => false],
            ['name' => 'Sonamarg', 'image' => 'assets/images/attraction/kashmir3.jpg', 'tag' => 'Best for mountain scenery', 'stay' => '0–1 Night', 'why' => 'Best suited for travellers who want to experience dramatic alpine landscapes.', 'nearby' => 'Thajiwas Glacier · Zero Point · Alpine Meadows', 'open' => false],
        ] as $i => $area) {
            $destination->areas()->create([
                'name' => $area['name'],
                'image' => $this->copyDemoImage($area['image'], 'area-' . $i),
                'tag' => $area['tag'],
                'stay_duration' => $area['stay'],
                'why_text' => $area['why'],
                'nearby_text' => $area['nearby'],
                'sort_order' => $i,
            ]);
        }

        // ---- Highlights ("Why Visit Kashmir?") ----
        // ⚠️ Assumed fields: icon, title, text, sort_order
        $destination->highlights()->delete();
        foreach ([
            ['icon' => 'assets/icon/mount.png', 'title' => 'Spectacular Himalayan Landscapes', 'text' => 'Towering peaks and open valleys at every turn.'],
            ['icon' => 'assets/icon/mount.png', 'title' => 'Dal Lake & Shikara Rides', 'text' => 'Glide past houseboats and floating gardens.'],
            ['icon' => 'assets/icon/snow.png', 'title' => 'Snow & Winter Activities', 'text' => "Skiing and snow play in Gulmarg's slopes."],
            ['icon' => 'assets/icon/garden.png', 'title' => 'Beautiful Valleys & Nature', 'text' => 'Meadows, pine forests, and quiet trails.'],
            ['icon' => 'assets/icon/mount.png', 'title' => 'Unique Kashmiri Cuisine', 'text' => 'Wazwan, kahwa, and flavors found nowhere else.'],
            ['icon' => 'assets/icon/garden.png', 'title' => 'Rich Local Crafts & Culture', 'text' => 'Pashmina, papier-mâché, and centuries-old craft.'],
        ] as $i => $highlight) {
            $destination->highlights()->create([
                'icon' => $highlight['icon'],
                'title' => $highlight['title'],
                'description' => $highlight['text'],
                'sort_order' => $i,
            ]);
        }

        // ---- Places to Visit ----
        // ⚠️ Assumed fields: name, image, description, is_large, sort_order
        $destination->places()->delete();
        foreach ([
            ['name' => 'Srinagar', 'image' => 'assets/images/attraction/kashmir1.jpg', 'desc' => 'Dal Lake, Mughal Gardens and local markets.', 'large' => true],
            ['name' => 'Gulmarg', 'image' => 'assets/images/attraction/kashmir2.jpg', 'desc' => 'Gondola, meadows, mountains and snow.', 'large' => false],
            ['name' => 'Pahalgam', 'image' => 'assets/images/attraction/kashmir3.jpg', 'desc' => 'Valleys, rivers and forests.', 'large' => false],
            ['name' => 'Sonamarg', 'image' => 'assets/images/attraction/kashmir4.jpg', 'desc' => 'Alpine scenery and mountain landscapes.', 'large' => false],
            ['name' => 'Doodhpathri', 'image' => 'assets/images/attraction/kashmir5.jpg', 'desc' => 'Peaceful meadows and natural surroundings.', 'large' => false],
        ] as $i => $place) {
            $destination->places()->create([
                'name' => $place['name'],
                'image' => $this->copyDemoImage($place['image'], 'place-' . $i),
                'description' => $place['desc'],
                'is_featured' => $place['large'],
                'sort_order' => $i,
            ]);
        }

        // ---- Activities ("Experiences You Shouldn't Miss") ----
        // ⚠️ Assumed fields: title, description, image, tag, is_large, sort_order
        $destination->activities()->delete();
        foreach ([
            ['title' => 'Shikara Ride', 'desc' => 'Experience Dal Lake from a traditional Shikara.', 'image' => 'assets/images/destinaiton/ride.jpg', 'tag' => 'Most Loved', 'large' => true],
            ['title' => 'Gondola Ride', 'desc' => 'Spectacular mountain views from Gulmarg.', 'image' => 'assets/images/destinaiton/ride2.jpg', 'tag' => null, 'large' => false],
            ['title' => 'Snow Activities', 'desc' => 'Skiing and winter activities in Gulmarg.', 'image' => 'assets/images/destinaiton/snow.avif', 'tag' => null, 'large' => false],
            ['title' => 'Mughal Gardens', 'desc' => "Explore Srinagar's historic gardens.", 'image' => 'assets/images/destinaiton/garder.jpg', 'tag' => null, 'large' => false],
            ['title' => 'Kashmiri Food Experience', 'desc' => 'Taste traditional local cuisine.', 'image' => 'assets/images/destinaiton/food.avif', 'tag' => null, 'large' => false],
        ] as $i => $activity) {
            $destination->activities()->create([
                'title' => $activity['title'],
                'description' => $activity['desc'],
                'image' => $this->copyDemoImage($activity['image'], 'activity-' . $i),
                'tag' => $activity['tag'],
                'is_featured' => $activity['large'],
                'sort_order' => $i,
            ]);
        }

        // ---- Routes ("Choose Your Kashmir Route") ----
        // ⚠️ Assumed fields: days, title, subtitle, path_text, note, sort_order
        $destination->routes()->delete();
        foreach ([
            ['days' => 3, 'title' => 'Quick Escape', 'subtitle' => 'Weekend trip', 'path' => 'Srinagar → Gulmarg → Srinagar', 'note' => null],
            ['days' => 5, 'title' => 'Highlights', 'subtitle' => 'Balanced pace', 'path' => 'Srinagar → Gulmarg → Pahalgam → Srinagar', 'note' => null],
            ['days' => 7, 'title' => 'Classic Kashmir', 'subtitle' => 'Most picked', 'path' => 'Srinagar → Gulmarg → Pahalgam → Sonamarg → Srinagar', 'note' => null],
            ['days' => 10, 'title' => 'Slow Explorer', 'subtitle' => 'Build your own', 'path' => null, 'note' => 'Add Doodhpathri, Yusmarg and additional experiences at your own pace.'],
        ] as $i => $route) {
            $destination->routes()->create([
                'days' => $route['days'],
                'label' => $route['title'],
                'subtitle' => $route['subtitle'],
                'path' => $route['path'],
                'note' => $route['note'],
                'sort_order' => $i,
            ]);
        }

        // ---- Journey Days ("A Sample 7-Day Kashmir Trip") ----
        // ⚠️ Assumed fields: day_number, title, flow_text, image, stay_text, food_text, is_end, sort_order
        $destination->journeyDays()->delete();
        $journeyDays = [
            ['title' => 'Srinagar', 'flow' => 'Arrival → Hotel check-in → Dal Lake → Shikara Ride', 'image' => 'assets/images/attraction/kashmir1.jpg', 'stay' => 'Srinagar', 'food' => 'Kahwa'],
            ['title' => 'Srinagar', 'flow' => 'Mughal Gardens → Old City → Local Market', 'image' => 'assets/images/attraction/kashmir2.jpg', 'stay' => 'Srinagar', 'food' => 'Yakhni'],
            ['title' => 'Gulmarg', 'flow' => 'Transfer → Gondola Ride → Mountain Experiences', 'image' => 'assets/images/attraction/kashmir3.jpg', 'stay' => 'Gulmarg', 'food' => 'Rogan Josh'],
            ['title' => 'Pahalgam', 'flow' => 'Transfer → Scenic Stops → Pahalgam', 'image' => 'assets/images/attraction/kashmir4.jpg', 'stay' => 'Pahalgam', 'food' => 'Wazwan'],
            ['title' => 'Pahalgam', 'flow' => 'Valleys → Nature Trails → Local Experiences', 'image' => 'assets/images/attraction/kashmir5.jpg', 'stay' => 'Pahalgam', 'food' => 'Rogan Josh'],
            ['title' => 'Sonamarg', 'flow' => 'Mountain Excursion → Scenic Views → Srinagar', 'image' => 'assets/images/attraction/kashmir3.jpg', 'stay' => 'Srinagar', 'food' => 'Kahwa'],
        ];
        foreach ($journeyDays as $i => $day) {
            $destination->journeyDays()->create([
                'day_number' => $i + 1,
                'title' => $day['title'],
                'flow_text' => $day['flow'],
                'image' => $this->copyDemoImage($day['image'], 'journey-' . $i),
                'stay_text' => $day['stay'],
                'food_text' => $day['food'],
                'is_departure' => false,
                'sort_order' => $i,
            ]);
        }
        $destination->journeyDays()->create([
            'day_number' => count($journeyDays) + 1,
            'title' => 'Departure',
            'flow_text' => 'Breakfast → Airport Transfer → End of Trip',
            'image' => null,
            'stay_text' => null,
            'food_text' => null,
            'is_departure' => true,
            'sort_order' => count($journeyDays),
        ]);

        // ---- Seasons ("Best Time to Visit") ----
        // ⚠️ Assumed fields: range_text, title, description, sort_order
        $destination->seasons()->delete();
        foreach ([
            ['range' => 'March – April', 'title' => 'Spring', 'desc' => 'Gardens, flowers and pleasant weather.'],
            ['range' => 'May – June', 'title' => 'Summer', 'desc' => 'Great for sightseeing and exploring valleys.'],
            ['range' => 'Sept – Nov', 'title' => 'Autumn', 'desc' => 'Cool weather and beautiful landscapes.'],
            ['range' => 'Dec – Feb', 'title' => 'Winter', 'desc' => 'Snow, skiing and winter experiences.'],
        ] as $i => $season) {
            $destination->seasons()->create([
                'range_text' => $season['range'],
                'name' => $season['title'],
                'description' => $season['desc'],
                'sort_order' => $i,
            ]);
        }

        // ---- Budget Tiers ----
        // ⚠️ Assumed fields: name, price_text, description, is_featured, badge_text, sort_order
        $destination->budgetTiers()->delete();
        foreach ([
            ['name' => 'Budget', 'price_suffix' => '₹', 'price_from' => '25,000',  'price_to' => '35,000', 'desc' => 'Basic stays, shared travel, local food.', 'featured' => false, 'badge' => null],
            ['name' => 'Comfort', 'price_suffix' => '₹', 'price_from' => '35,000', 'price_to' => '60,000', 'desc' => '3-star stays, private cabs, curated experiences.', 'featured' => true, 'badge' => 'Popular'],
            ['name' => 'Premium', 'price_suffix' => '₹', 'price_from' => '60,000', 'price_to' => '+', 'desc' => 'Luxury stays, private transport, top experiences.', 'featured' => false, 'badge' => null],
        ] as $i => $tier) {
            $destination->budgetTiers()->create([
                'name' => $tier['name'],
                'price_from' => $tier['price_from'],
                'price_to' => $tier['price_to'],
                'price_suffix' => $tier['price_suffix'],
                'description' => $tier['desc'],
                'is_featured' => $tier['featured'],
                'badge_text' => $tier['badge'],
                'sort_order' => $i,
            ]);
        }

        // ---- Budget Breakdown ----
        // ⚠️ Assumed fields: label, percentage, sort_order
        $destination->budgetBreakdown()->delete();
        foreach ([
            ['label' => 'Stay', 'percentage' => 40],
            ['label' => 'Transport', 'percentage' => 25],
            ['label' => 'Food', 'percentage' => 20],
            ['label' => 'Activities', 'percentage' => 15],
        ] as $i => $row) {
            $destination->budgetBreakdown()->create([
                'label' => $row['label'],
                'percent' => $row['percentage'],
                'sort_order' => $i,
            ]);
        }

        // ---- FAQs ----
        $destination->faqs()->delete();
        foreach ([
            ['q' => 'How many days are enough for Kashmir?', 'a' => '5–7 days is ideal for a first-time visit and allows you to experience major destinations such as Srinagar, Gulmarg and Pahalgam.'],
            ['q' => 'Where should I stay in Kashmir?', 'a' => 'Srinagar is a good base for exploring Kashmir, while adding Gulmarg and Pahalgam gives you a more complete experience of the region.'],
            ['q' => 'What is the best time to visit Kashmir?', 'a' => 'March–October is popular for sightseeing and pleasant weather, while winter is best for experiencing snow and winter activities.'],
            ['q' => 'How do I travel between destinations?', 'a' => 'Private cars and taxis are convenient options for travelling between most destinations in Kashmir, especially when visiting multiple places during one trip.'],
            ['q' => 'Can I create my own Kashmir itinerary?', 'a' => 'Yes. Select your preferred destinations, stays and experiences to create a Kashmir itinerary that matches your travel style and trip duration.'],
        ] as $i => $faq) {
            $destination->faqs()->create([
                'question' => $faq['q'],
                'answer' => $faq['a'],
                'sort_order' => $i,
            ]);
        }

        // ---- Attach this Destination to existing Tour Packages ----
        // NOTE: your seeded packages so far are Ladakh trips, not Kashmir — this just
        // proves the many-to-many link works end to end with dummy data. Swap in real
        // Kashmir packages (or drop this block) once you have them.
        $tourPackages = TourPackage::all();
        foreach ($tourPackages as $i => $tp) {
            $tp->destinations()->syncWithoutDetaching([$destination->id => ['sort_order' => 0]]);
        }

        $this->command->info('Kashmir destination seeded and attached to ' . $tourPackages->count() . ' tour package(s).');
    }

    private function copyDemoImage(string $publicRelativePath, string $label): ?string
    {
        $source = public_path($publicRelativePath);

        if (!File::exists($source)) {
            return null;
        }

        $destinationDir = storage_path('app/public/destinations/demo');
        File::ensureDirectoryExists($destinationDir);

        $filename = $label . '-' . Str::random(6) . '.' . File::extension($source);
        File::copy($source, $destinationDir . '/' . $filename);

        return 'destinations/demo/' . $filename;
    }
}