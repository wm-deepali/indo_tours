<?php
// database/seeders/AttractionSeeder.php

namespace Database\Seeders;

use App\Models\Attraction;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\TourPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AttractionSeeder extends Seeder
{
    public function run(): void
    {
        $country = Country::firstOrCreate(['name' => 'India']);
        $state = State::firstOrCreate(['name' => 'Jammu and Kashmir', 'country_id' => $country->id]);
        $city = City::firstOrCreate(['name' => 'Srinagar', 'state_id' => $state->id]);

        $attraction = Attraction::updateOrCreate(
            ['slug' => 'kashmir'],
            [
                'name' => 'Kashmir',
                'image' => $this->copyDemoImage('assets/images/attraction/kashmir1.jpg', 'attraction-main'),
                'about_image' => $this->copyDemoImage('assets/images/attraction/kashmir3.jpg', 'attraction-about'),

                'short_description' => "Discover the breathtaking beauty of Kashmir, known for its snow-capped mountains, peaceful lakes, lush valleys and charming hill towns. From a relaxing Shikara ride on Dal Lake to exploring Gulmarg and Pahalgam, Kashmir offers unforgettable experiences for every kind of traveller.",

                'description' => "Discover the breathtaking beauty of Kashmir, known for its snow-capped mountains, peaceful lakes, lush valleys and charming hill towns.",

                'about_content' => "Kashmir is one of India's most beautiful travel destinations, surrounded by the majestic Himalayas and famous for its scenic landscapes, lakes, gardens and peaceful valleys.\n\nFrom the lively streets of Srinagar to the snow-covered slopes of Gulmarg and the beautiful valleys of Pahalgam, every part of Kashmir offers something different to explore.\n\nWhether you're looking for nature, adventure, culture or a relaxing getaway, Kashmir is a destination that can be easily included in a personalized travel itinerary.",

                'about_more_title' => 'More About Dal Lake',
                'about_more_content' => "Dal Lake is one of the most popular attractions in Srinagar, known for its beautiful surroundings, traditional houseboats and peaceful lake experiences. It is an important highlight for travellers exploring Kashmir.\n\nVisitors can enjoy a peaceful Shikara Ride across the lake, explore traditional houseboats and floating markets, capture beautiful views of the surrounding mountains, and explore nearby Srinagar attractions and cultural landmarks.",

                'offer_badge_text' => 'Limited-Time Offer',
                'offer_title' => 'Book Your Kashmir & Ladakh Trip Early — Save Up to 40%',
                'offer_description' => 'Grab early-booking discounts, seasonal deals and free add-on experiences before this offer ends.',
                'offer_perks' => [
                    'Early Bird Discount up to 40% Off',
                    'Free Airport Transfers Included',
                    'Flexible Rescheduling on Select Packages',
                ],
                'offer_image' => $this->copyDemoImage('assets/images/home/party.jpg', 'attraction-offer'),
                'offer_button_text' => 'Explore Packages',
                'offer_button_url' => null,

                'duration_text' => '4–7 Days',
                'best_time_text' => 'March – October',
                'best_for_tags' => ['Families', 'Couples', 'Adventure', 'Nature'],

                'rating' => 4.8,
                'review_count' => 124,
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 0,

                'country_id' => $country->id,
                'state_id' => $state->id,
                'city_id' => $city->id,
                'map_location' => 'Kashmir, Jammu and Kashmir, India',

                'h1' => 'Kashmir',
                'meta_title' => 'Kashmir Attractions | Indo Tours & Adventures',
                'meta_description' => 'Explore Kashmir — Dal Lake, Gulmarg, Pahalgam and Sonamarg — with handpicked experiences, places to visit and travel tips.',
                'og_title' => 'Kashmir | Indo Tours & Adventures',
                'og_description' => 'Discover the breathtaking beauty of Kashmir — snow-capped mountains, peaceful lakes and lush valleys.',
                'og_image' => $this->copyDemoImage('assets/images/attraction/kashmir1.jpg', 'attraction-og'),
                'canonical_url' => url('/attractions/kashmir'),

                'promo_eyebrow' => 'Plan Your Trip',
                'promo_title' => 'Ready to Explore Kashmir?',
                'promo_description' => 'Create your personalized Kashmir itinerary and discover the best places, experiences and attractions based on your travel style.',
                'promo_button_text' => 'Plan My Kashmir Trip',
                'promo_button_url' => null,
            ]
        );

        // ---- Galleries (banner grid) ----
        // ⚠️ Assumed fields: image, title, subtitle, sort_order
        $attraction->galleries()->delete();
        foreach ([
            ['image' => 'assets/images/attraction/kashmir1.jpg', 'title' => 'Dal Lake', 'subtitle' => 'Srinagar, Kashmir'],
            ['image' => 'assets/images/attraction/kashmir2.jpg', 'title' => 'Gulmarg', 'subtitle' => 'Kashmir'],
            ['image' => 'assets/images/attraction/kashmir3.jpg', 'title' => 'Pahalgam', 'subtitle' => 'Kashmir'],
            ['image' => 'assets/images/attraction/kashmir4.jpg', 'title' => 'Sonamarg', 'subtitle' => 'Kashmir'],
            ['image' => 'assets/images/attraction/kashmir5.jpg', 'title' => 'Kashmir Attractions', 'subtitle' => '14+'],
        ] as $i => $gallery) {
            $attraction->galleries()->create([
                'image' => $this->copyDemoImage($gallery['image'], 'gallery-' . $i),
                'title' => $gallery['title'],
                'subtitle' => $gallery['subtitle'],
                'sort_order' => $i,
            ]);
        }

        // ---- Highlights ("Why Visit Kashmir?") ----
        // ⚠️ Assumed fields: icon, title, text, sort_order
        $attraction->highlights()->delete();
        foreach ([
            ['icon' => 'assets/icon/mount.png', 'title' => 'Himalayan Landscapes', 'text' => 'Experience spectacular mountain views, green valleys and peaceful natural surroundings.'],
            ['icon' => 'assets/icon/lake.png', 'title' => 'Dal Lake', 'text' => "Enjoy a traditional Shikara ride and experience the beauty of Srinagar's famous lake."],
            ['icon' => 'assets/icon/marg.png', 'title' => 'Gulmarg', 'text' => "Explore one of India's most popular mountain destinations, known for skiing and the Gulmarg Gondola."],
            ['icon' => 'assets/icon/mount.png', 'title' => 'Pahalgam', 'text' => 'Discover beautiful forests, rivers and mountain scenery in the peaceful valley of Pahalgam.'],
            ['icon' => 'assets/icon/garden.png', 'title' => 'Mughal Gardens', 'text' => 'Visit beautifully designed historic gardens including Nishat Bagh and Shalimar Bagh.'],
            ['icon' => 'assets/icon/adventures.png', 'title' => 'Adventure', 'text' => 'Enjoy activities such as skiing, trekking, cable-car rides and river experiences depending on the season.'],
        ] as $i => $highlight) {
            $attraction->highlights()->create([
                'icon' => $highlight['icon'],
                'title' => $highlight['title'],
                'description' => $highlight['text'],
                'sort_order' => $i,
            ]);
        }

        // ---- Experiences ("Experiences to Explore") ----
        // ⚠️ Assumed fields: image, title, description, duration_text, sort_order
        $attraction->experiences()->delete();
        foreach ([
            ['image' => 'assets/images/attraction/kashmir1.jpg', 'title' => 'Shikara Ride on Dal Lake', 'desc' => 'Take a peaceful Shikara ride across Dal Lake and enjoy views of the surrounding mountains, houseboats and floating markets.', 'duration' => '1–2 Hours'],
            ['image' => 'assets/images/attraction/kashmir2.jpg', 'title' => 'Explore Gulmarg', 'desc' => "Visit Gulmarg for beautiful mountain scenery, outdoor activities and one of the world's highest cable-car experiences.", 'duration' => '1 Day'],
            ['image' => 'assets/images/attraction/kashmir3.jpg', 'title' => 'Visit Pahalgam', 'desc' => "Explore the scenic valleys, rivers and forests of Pahalgam, one of Kashmir's most popular mountain destinations.", 'duration' => '1 Day'],
            ['image' => 'assets/images/attraction/kashmir4.jpg', 'title' => 'Visit Mughal Gardens', 'desc' => "Walk through Kashmir's historic Mughal gardens and enjoy beautifully landscaped grounds, fountains and mountain views.", 'duration' => '2–3 Hours'],
            ['image' => 'assets/images/attraction/kashmir5.jpg', 'title' => 'Ride the Gulmarg Gondola', 'desc' => 'Take the cable car toward the higher slopes of Gulmarg for spectacular views of the surrounding Himalayan landscape.', 'duration' => '2–4 Hours'],
            ['image' => 'assets/images/attraction/kashmir3.jpg', 'title' => 'Explore Srinagar', 'desc' => "Discover Srinagar's old city, local markets, traditional architecture and famous lakeside attractions.", 'duration' => 'Half Day'],
        ] as $i => $experience) {
            $attraction->experiences()->create([
                'image' => $this->copyDemoImage($experience['image'], 'experience-' . $i),
                'title' => $experience['title'],
                'description' => $experience['desc'],
                'duration_text' => $experience['duration'],
                'sort_order' => $i,
            ]);
        }

        // ---- Places ("Places to Visit in Kashmir") ----
        // ⚠️ Assumed fields: name, image, tag_text, description, button_text, sort_order
        $attraction->places()->delete();
        foreach ([
            ['name' => 'Srinagar', 'image' => 'assets/images/attraction/kashmir1.jpg', 'desc' => 'The cultural heart of Kashmir, famous for Dal Lake, gardens, houseboats and historic neighbourhoods.'],
            ['name' => 'Gulmarg', 'image' => 'assets/images/attraction/kashmir2.jpg', 'desc' => 'A beautiful mountain resort known for skiing, meadows and spectacular Himalayan views.'],
            ['name' => 'Pahalgam', 'image' => 'assets/images/attraction/kashmir3.jpg', 'desc' => 'A peaceful valley surrounded by forests, rivers and mountains.'],
            ['name' => 'Sonamarg', 'image' => 'assets/images/attraction/kashmir4.jpg', 'desc' => 'Known for its dramatic mountain scenery, glaciers and scenic alpine landscapes.'],
        ] as $i => $place) {
            $attraction->places()->create([
                'title' => $place['name'],
                'image' => $this->copyDemoImage($place['image'], 'place-' . $i),
                'tag' => 'Kashmir',
                'description' => $place['desc'],
                'button_text' => 'Explore ' . $place['name'],
                'sort_order' => $i,
            ]);
        }

        // ---- Itineraries ("How Many Days Do You Need?") ----
        // Model fields: attraction_id, days, title, is_popular, sort_order
        // Route stops are stored via the related AttractionItineraryStop model (stop_name, sort_order)
        $attraction->itineraries()->delete();
        foreach ([
            [
                'days' => 3,
                'title' => 'Srinagar Highlights',
                'stops' => ['Dal Lake', 'Mughal Gardens', 'Srinagar Sightseeing'],
                'popular' => false,
            ],
            [
                'days' => 5,
                'title' => 'Kashmir Essentials',
                'stops' => ['Srinagar', 'Gulmarg', 'Pahalgam', 'Srinagar'],
                'popular' => true,
            ],
            [
                'days' => 7,
                'title' => 'Complete Kashmir Experience',
                'stops' => ['Srinagar', 'Gulmarg', 'Pahalgam', 'Sonamarg', 'Srinagar'],
                'popular' => false,
            ],
        ] as $i => $plan) {
            $itinerary = $attraction->itineraries()->create([
                'days' => $plan['days'],
                'title' => $plan['title'],
                'is_popular' => $plan['popular'],
                'sort_order' => $i,
            ]);

            foreach ($plan['stops'] as $j => $stopName) {
                $itinerary->stops()->create([
                    'stop_name' => $stopName,
                    'sort_order' => $j,
                ]);
            }
        }

        // ---- Seasons ("Best Time to Visit") ----
        // ⚠️ Assumed fields: months_text, title, description, tags, is_active, sort_order
        $attraction->seasons()->delete();
        foreach ([
            ['months' => 'Mar – May', 'title' => 'Spring', 'desc' => 'Tulip gardens bloom and the valley turns green after winter snow melts.', 'tags' => ['Gardens', 'Fewer crowds'], 'active' => false],
            ['months' => 'Jun – Aug', 'title' => 'Summer', 'desc' => 'Pleasant weather, ideal for Dal Lake, Gulmarg meadows and Pahalgam valleys.', 'tags' => ['Lakes', 'Sightseeing'], 'active' => true],
            ['months' => 'Sep – Nov', 'title' => 'Autumn', 'desc' => 'Chinar leaves turn gold and red — one of the most photogenic times to visit.', 'tags' => ['Foliage', 'Photography'], 'active' => false],
            ['months' => 'Dec – Feb', 'title' => 'Winter', 'desc' => 'Snow blankets Gulmarg, drawing skiers and snowboarders from across the world.', 'tags' => ['Skiing', 'Snowfall'], 'active' => false],
        ] as $i => $season) {
            $attraction->seasons()->create([
                'months' => $season['months'],
                'title' => $season['title'],
                'description' => $season['desc'],
                'tags' => $season['tags'],
                'is_active' => $season['active'],
                'sort_order' => $i,
            ]);
        }

        // ---- Transports ("How to Reach") ----
        // ⚠️ Assumed fields: mode_name, mode_sub, description, sort_order
        $attraction->transports()->delete();
        foreach ([
            ['mode' => 'By Air', 'sub' => 'Srinagar Airport (SXR)', 'desc' => 'Srinagar Airport is the main gateway to the region, with regular flights connecting Delhi, Mumbai and other major Indian cities.'],
            ['mode' => 'By Road', 'sub' => 'NH44 highway', 'desc' => 'Kashmir is connected to major cities in North India by road, with scenic mountain drives through Jammu.'],
            ['mode' => 'By Train', 'sub' => 'Jammu Tawi station', 'desc' => 'The railway network connects parts of the region, with onward travel to Srinagar completed by road.'],
        ] as $i => $transport) {
            $attraction->transports()->create([
                'mode_name' => $transport['mode'],
                'mode_sub' => $transport['sub'],
                'description' => $transport['desc'],
                'sort_order' => $i,
            ]);
        }

        // ---- Budget Tiers ("Estimated Budget") ----
        // ⚠️ Assumed fields: tier_name, price_text, note, features, is_recommended, sort_order
        $attraction->budgetTiers()->delete();
        foreach ([
            [
                'tier' => 'Budget',
                'price_unit'=> '/ day',
                'price' => '₹2,000 – ₹4,000',
                'note' => 'Good for solo travellers and backpackers',
                'features' => ['Guesthouses and homestays', 'Shared local transport', 'Local dhaba meals', 'Self-planned sightseeing'],
                'recommended' => false,
            ],
            [
                'tier' => 'Mid-range',
                'price_unit'=> '/ day',
                'price' => '₹4,000 – ₹8,000',
                'note' => 'Best value for families and couples',
                'features' => ['3-star hotels or deluxe houseboats', 'Private cab for sightseeing', 'Mix of local and multi-cuisine meals', 'Guided day trips included'],
                'recommended' => true,
            ],
            [
                'tier' => 'Premium',
                'price_unit'=> '/ day',
                'price' => '₹8,000+',
                'note' => 'For a fully curated, comfort-first trip',
                'features' => ['Luxury resorts and premium houseboats', 'Private car with driver, full trip', 'Curated dining experiences', 'Personal guide and priority bookings'],
                'recommended' => false,
            ],
        ] as $i => $tier) {
            $attraction->budgetTiers()->create([
                'tier_name' => $tier['tier'],
                'price_unit' => $tier['price_unit'],
                'price_range' => $tier['price'],
                'note' => $tier['note'],
                'features' => $tier['features'],
                'is_recommended' => $tier['recommended'],
                'sort_order' => $i,
            ]);
        }

        // ---- Carry Groups ("What to Carry") ----
        // ⚠️ Assumed fields: title, items, sort_order
        $attraction->carryGroups()->delete();
        foreach ([
            ['title' => 'Clothing & Footwear', 'items' => ['Comfortable walking shoes', 'Light jacket', 'Weather-appropriate clothing']],
            ['title' => 'Essentials', 'items' => ['Sunglasses', 'Sunscreen', 'Power bank and adapter']],
            ['title' => 'Health & Safety', 'items' => ['Personal medicines', 'Basic first-aid kit', 'Reusable water bottle']],
        ] as $i => $group) {
            $attraction->carryGroups()->create([
                'title' => $group['title'],
                'items' => $group['items'],
                'sort_order' => $i,
            ]);
        }

        // ---- FAQs ----
        $attraction->faqs()->delete();
        foreach ([
            ['q' => 'What is the best time to visit Kashmir?', 'a' => 'The best time depends on your interests. March to October is popular for sightseeing and pleasant weather, while winter is preferred for snow and skiing.'],
            ['q' => 'How many days are enough for Kashmir?', 'a' => 'A 5–7 day trip is a good starting point for experiencing major destinations such as Srinagar, Gulmarg and Pahalgam.'],
            ['q' => 'What are the must-visit places in Kashmir?', 'a' => 'Popular places include Srinagar, Dal Lake, Gulmarg, Pahalgam and Sonamarg.'],
            ['q' => 'Is Kashmir suitable for families?', 'a' => 'Yes. Kashmir offers a mix of sightseeing, nature, relaxing experiences and activities suitable for many types of family trips.'],
            ['q' => 'What are the top things to do in Kashmir?', 'a' => 'Popular experiences include a Shikara ride on Dal Lake, exploring Mughal gardens, enjoying the meadows of Gulmarg and Pahalgam, and experiencing the scenic beauty of Sonamarg.'],
        ] as $i => $faq) {
            $attraction->faqs()->create([
                'question' => $faq['q'],
                'answer' => $faq['a'],
                'sort_order' => $i,
            ]);
        }

        // ---- Attach this Attraction to existing Tour Packages ----
        $tourPackages = TourPackage::all();
        foreach ($tourPackages as $tp) {
            $tp->attractions()->syncWithoutDetaching([$attraction->id => ['sort_order' => 0]]);
        }

        $this->command->info('Kashmir attraction seeded and attached to ' . $tourPackages->count() . ' tour package(s).');
    }

    private function copyDemoImage(string $publicRelativePath, string $label): ?string
    {
        $source = public_path($publicRelativePath);

        if (!File::exists($source)) {
            return null;
        }

        $destinationDir = storage_path('app/public/attractions/demo');
        File::ensureDirectoryExists($destinationDir);

        $filename = $label . '-' . Str::random(6) . '.' . File::extension($source);
        File::copy($source, $destinationDir . '/' . $filename);

        return 'attractions/demo/' . $filename;
    }
}