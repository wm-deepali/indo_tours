<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\SubCategory;
use App\Models\TourPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TourPackageSeeder extends Seeder
{
    public function run(): void
    {
        $subCategory = SubCategory::where('slug', 'ladakh-family-package')->first()
            ?? SubCategory::first();

        if (!$subCategory) {
            $this->command->warn('No SubCategory found — run CategorySubCategorySeeder first. Skipping TourPackageSeeder.');
            return;
        }

        $hotelOne = Hotel::firstOrCreate(
            ['name' => 'The Grand Dragon Ladakh'],
            ['slug' => Str::slug('The Grand Dragon Ladakh'), 'status' => 'published']
        );

        $hotelTwo = Hotel::firstOrCreate(
            ['name' => 'Zen Ladakh Resort'],
            ['slug' => Str::slug('Zen Ladakh Resort'), 'status' => 'published']
        );

        $hotelThree = Hotel::firstOrCreate(
            ['name' => 'Nubra Sarai Resort'],
            ['slug' => Str::slug('Nubra Sarai Resort'), 'status' => 'published']
        );

        $hotelFour = Hotel::firstOrCreate(
            ['name' => 'Pangong Heights Camp'],
            ['slug' => Str::slug('Pangong Heights Camp'), 'status' => 'published']
        );

        $this->seedPackage($subCategory, [
            'slug' => 'leh-ladakh-expedition',
            'name' => 'Leh Ladakh Expedition',
            'banner_tag_text' => 'Explore Ladakh',
            'banner_intro' => 'Discover breathtaking mountains, peaceful monasteries, high-altitude lakes and unforgettable Himalayan experiences.',
            'main_image' => 'assets/images/listing/banner1.jpg',
            'top_image' => 'assets/images/listing/banner2.jpg',
            'bottom_left_image' => 'assets/images/listing/banner1.jpg',
            'bottom_right_image' => 'assets/images/listing/banner2.jpg',
            'video_url' => 'assets/video/trip.mp4',
            'duration_text' => '6D / 5N',
            'old_price' => 29500,
            'price' => 22900,
            'price_unit_text' => 'Per Adult',
            'overview_title' => 'About This Tour',
            'overview_content' => "Ladakh is a land of dramatic contrasts — snow-capped peaks, high-altitude desert, turquoise lakes and centuries-old Buddhist monasteries. This tour is crafted to take the stress out of planning and altitude logistics, guiding you from the winding lanes of Old Leh to the vast open silence of Nubra Valley and Pangong Tso. Experience the timeless spiritual heritage and raw Himalayan landscape of Ladakh in one seamless journey.",
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.0830313310485!2d77.36992837511725!3d28.627273475667696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5a035689a39%3A0x3d9564cd104c4b57!2sWeb%20Mingo%20IT%20Solutions!5e0!3m2!1sen!2sin!4v1786444341738!5m2!1sen!2sin',
            'meta_title' => 'Leh Ladakh Expedition | Indo Tours & Adventures',
            'meta_description' => 'Book the 6D/5N Leh Ladakh Expedition covering Leh, Nubra Valley and Pangong Tso, with transfers, stay and meals included.',

            'features' => ['Transfers Included', 'Stay Included', 'Meals Included', 'Sightseeing Included'],

            'duration_options' => [
                ['label' => '4 days', 'price' => 14999, 'image' => 'assets/images/listing/rarting-view.jpg'],
                ['label' => '5 days', 'price' => 18500, 'image' => 'assets/images/home/card4.jpg'],
                ['label' => '6 days', 'price' => 22900, 'image' => 'assets/images/home/card3.jpg'],
                ['label' => '7 days', 'price' => 26500, 'image' => 'assets/images/home/card1.jpg'],
                ['label' => '8 days', 'price' => 31900, 'image' => 'assets/images/home/card2.jpg'],
            ],

            'route_stops' => ['Leh', 'Nubra Valley', 'Pangong Tso', 'Leh'],

            'highlights' => [
                'Explore the dramatic contrast between ancient monasteries and vast Himalayan desert.',
                'Your expert guide shares stories of Ladakh\'s Buddhist heritage and high-altitude culture.',
                'A stress-free introduction to one of India\'s most remote and breathtaking regions.',
            ],

            'itinerary' => [
                ['title' => 'Day 01 : Arrival in Leh and Acclimatization', 'content' => 'Welcome to Leh! After settling into your hotel, spend the day resting and acclimatizing to the high altitude. In the evening, take a short stroll through the Leh Market to soak in the local atmosphere.'],
                ['title' => 'Day 02 : Exploring the Monasteries of Old Leh', 'content' => 'Visit Leh Palace and Shanti Stupa for panoramic views of the town, then explore the centuries-old Thiksey and Shey Monasteries.'],
                ['title' => 'Day 03 : Nubra Valley via Khardung La', 'content' => 'Cross one of the world\'s highest motorable passes, Khardung La, en route to Nubra Valley. Enjoy a camel safari on the sand dunes of Hunder before an overnight stay under the stars.'],
                ['title' => 'Day 04 : Pangong Tso and Departure', 'content' => 'Drive to the stunning turquoise waters of Pangong Tso before returning to Leh for your onward departure.'],
            ],

            'hotel_stays' => [
                ['hotel_id' => $hotelOne->id, 'day_label' => 'Day 1', 'title' => 'Arrival in Leh | Day at Leisure', 'check_in' => '2:00 PM', 'check_out' => '11:00 AM', 'breakfast' => true, 'lunch' => false, 'dinner' => false],
                ['hotel_id' => $hotelTwo->id, 'day_label' => 'Day 4', 'title' => 'Transfer to Nubra Valley | Day at Leisure', 'check_in' => '5:30 PM', 'check_out' => '11:00 AM', 'breakfast' => true, 'lunch' => false, 'dinner' => false],
            ],

            'includes' => ['Professional Tour Guide', 'Air-Conditioned Tour Vehicle', 'Bottled Mineral Water', 'Hotel Pickup & Drop-off', 'All Entry Permits & Tickets'],
            'excludes' => ['Personal Travel Insurance', 'Lunch & Additional Meals', 'Gratuities / Tips for Guide', 'Optional Activities & Upgrades', 'Souvenirs & Personal Expenses'],

            'policies' => $this->standardPolicies(),
        ]);

        $this->seedPackage($subCategory, [
            'slug' => 'ladakh-family-discovery-tour',
            'name' => 'Ladakh Family Discovery Tour',
            'banner_tag_text' => 'Family Trips to Ladakh',
            'banner_intro' => 'A relaxed, family-friendly journey through Ladakh — comfortable stays, easy pacing, and experiences the whole family will remember.',
            'main_image' => 'assets/images/listing/banner2.jpg',
            'top_image' => 'assets/images/listing/banner1.jpg',
            'bottom_left_image' => 'assets/images/home/card1.jpg',
            'bottom_right_image' => 'assets/images/home/card2.jpg',
            'video_url' => 'assets/video/trip.mp4',
            'duration_text' => '5D / 4N',
            'old_price' => 26500,
            'price' => 20900,
            'price_unit_text' => 'Per Adult',
            'overview_title' => 'About This Tour',
            'overview_content' => "Designed with families in mind, this Ladakh itinerary keeps the pace gentle while still covering the region's most memorable sights. Extra acclimatization time, family-friendly hotel rooms, and shorter drive days make this a comfortable introduction to Ladakh for travellers of all ages — from young children to grandparents.",
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.0830313310485!2d77.36992837511725!3d28.627273475667696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5a035689a39%3A0x3d9564cd104c4b57!2sWeb%20Mingo%20IT%20Solutions!5e0!3m2!1sen!2sin!4v1786444341738!5m2!1sen!2sin',
            'meta_title' => 'Ladakh Family Discovery Tour | Indo Tours & Adventures',
            'meta_description' => 'A 5D/4N family-friendly Ladakh tour with relaxed pacing, comfortable stays and kid-friendly sightseeing across Leh and Nubra Valley.',

            'features' => ['Family Rooms Included', 'Relaxed Pacing', 'Meals Included', 'Kid-Friendly Sightseeing'],

            'duration_options' => [
                ['label' => '3 days', 'price' => 12999, 'image' => 'assets/images/home/card3.jpg'],
                ['label' => '4 days', 'price' => 16500, 'image' => 'assets/images/home/card4.jpg'],
                ['label' => '5 days', 'price' => 20900, 'image' => 'assets/images/listing/rarting-view.jpg'],
                ['label' => '6 days', 'price' => 24900, 'image' => 'assets/images/listing/banner1.jpg'],
            ],

            'route_stops' => ['Leh', 'Nubra Valley', 'Leh'],

            'highlights' => [
                'Gentle acclimatization schedule suited to children and older travellers.',
                'Family-friendly hotels with connecting or larger rooms wherever possible.',
                'Shorter drive days with more time to rest and enjoy each stop.',
            ],

            'itinerary' => [
                ['title' => 'Day 01 : Arrival in Leh and Relaxed Acclimatization', 'content' => 'Arrive in Leh and check into your family room. Spend the day resting as a family to acclimatize, with an easy evening walk around Leh Market.'],
                ['title' => 'Day 02 : Leh Palace, Shanti Stupa and Local Sights', 'content' => 'A relaxed half-day covering Leh Palace and Shanti Stupa, with the afternoon left free for the family to rest or explore at their own pace.'],
                ['title' => 'Day 03 : Nubra Valley Family Excursion', 'content' => 'Drive to Nubra Valley with frequent stops for photos and rest. Enjoy a gentle camel ride on the Hunder sand dunes, suitable for all ages.'],
                ['title' => 'Day 04 : Return to Leh and Departure', 'content' => 'A relaxed drive back to Leh with time for last-minute souvenir shopping before your onward departure.'],
            ],

            'hotel_stays' => [
                ['hotel_id' => $hotelOne->id, 'day_label' => 'Day 1', 'title' => 'Arrival in Leh | Family Room Stay', 'check_in' => '2:00 PM', 'check_out' => '11:00 AM', 'breakfast' => true, 'lunch' => false, 'dinner' => true],
                ['hotel_id' => $hotelThree->id, 'day_label' => 'Day 3', 'title' => 'Nubra Valley | Family Room Stay', 'check_in' => '4:00 PM', 'check_out' => '10:00 AM', 'breakfast' => true, 'lunch' => false, 'dinner' => true],
            ],

            'includes' => ['Professional Family-Friendly Guide', 'Air-Conditioned Tour Vehicle', 'Bottled Mineral Water', 'Hotel Pickup & Drop-off', 'All Entry Permits & Tickets', 'Family Room Upgrades Where Available'],
            'excludes' => ['Personal Travel Insurance', 'Lunch on Free Days', 'Gratuities / Tips for Guide', 'Optional Activities & Upgrades', 'Souvenirs & Personal Expenses'],

            'policies' => $this->standardPolicies(),
        ]);

        $this->command->info('2 Ladakh tour packages seeded.');

        // avoid unused-var warning if hotelFour isn't referenced above in your final data
        unset($hotelFour);
    }

    private function seedPackage(SubCategory $subCategory, array $data): void
    {
        $tourPackage = TourPackage::updateOrCreate(
            ['slug' => $data['slug']],
            [
                'sub_category_id' => $subCategory->id,
                'name' => $data['name'],
                'status' => 'published',

                'banner_tag_text' => $data['banner_tag_text'],
                'banner_intro' => $data['banner_intro'],
                'main_image' => $this->copyDemoImage($data['main_image'], 'main'),
                'top_image' => $this->copyDemoImage($data['top_image'], 'top'),
                'bottom_left_image' => $this->copyDemoImage($data['bottom_left_image'], 'bottom-left'),
                'bottom_right_image' => $this->copyDemoImage($data['bottom_right_image'], 'bottom-right'),
                'video_url' => $data['video_url'],

                'duration_text' => $data['duration_text'],
                'old_price' => $data['old_price'],
                'price' => $data['price'],
                'price_unit_text' => $data['price_unit_text'],

                'overview_title' => $data['overview_title'],
                'overview_content' => $data['overview_content'],

                'map_embed_url' => $data['map_embed_url'],

                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
            ]
        );

        $tourPackage->features()->delete();
        foreach ($data['features'] as $i => $text) {
            $tourPackage->features()->create(['text' => $text, 'sort_order' => $i]);
        }

        $tourPackage->durationOptions()->delete();
        foreach ($data['duration_options'] as $i => $option) {
            $tourPackage->durationOptions()->create([
                'days_label' => $option['label'],
                'price' => $option['price'],
                'image' => $this->copyDemoImage($option['image'], 'duration-' . $i),
                'sort_order' => $i,
            ]);
        }

        $tourPackage->routeStops()->delete();
        foreach ($data['route_stops'] as $i => $name) {
            $tourPackage->routeStops()->create(['name' => $name, 'sort_order' => $i]);
        }

        $tourPackage->highlights()->delete();
        foreach ($data['highlights'] as $i => $text) {
            $tourPackage->highlights()->create(['text' => $text, 'sort_order' => $i]);
        }

        $tourPackage->itineraryDays()->delete();
        foreach ($data['itinerary'] as $i => $day) {
            $tourPackage->itineraryDays()->create([
                'day_number' => $i + 1,
                'title' => $day['title'],
                'content' => $day['content'],
                'sort_order' => $i,
            ]);
        }

        $tourPackage->hotelStays()->delete();
        foreach ($data['hotel_stays'] as $i => $stay) {
            $tourPackage->hotelStays()->create([
                'hotel_id' => $stay['hotel_id'],
                'day_label' => $stay['day_label'],
                'title' => $stay['title'],
                'check_in' => $stay['check_in'],
                'check_out' => $stay['check_out'],
                'breakfast_included' => $stay['breakfast'],
                'lunch_included' => $stay['lunch'],
                'dinner_included' => $stay['dinner'],
                'sort_order' => $i,
            ]);
        }

        $tourPackage->includes()->delete();
        foreach ($data['includes'] as $i => $text) {
            $tourPackage->includes()->create(['text' => $text, 'sort_order' => $i]);
        }

        $tourPackage->excludes()->delete();
        foreach ($data['excludes'] as $i => $text) {
            $tourPackage->excludes()->create(['text' => $text, 'sort_order' => $i]);
        }

        $tourPackage->policies()->delete();
        foreach ($data['policies'] as $i => $policy) {
            $tourPackage->policies()->create([
                'title' => $policy['title'],
                'content' => $policy['content'],
                'sort_order' => $i,
            ]);
        }
    }

    private function standardPolicies(): array
    {
        return [
            [
                'title' => 'Confirmation Policy',
                'content' => "Payment can be done in parts.\nAfter making your first payment, you will receive an email confirmation with your booking details.\nOnce you make the 100% payment for your booking, you will receive the final booking voucher containing all the information about your trip.\nCustomers are advised to verify all booking details mentioned in the confirmation email.",
            ],
            [
                'title' => 'Refund Policy',
                'content' => "The applicable refund amount will be processed within 7–10 business days.\nRefunds will be processed to the original payment method wherever applicable.\nProcessing time may vary depending on the customer's bank or payment provider.\nAny applicable cancellation charges will be deducted before processing the refund.",
            ],
            [
                'title' => 'Cancellation Policy',
                'content' => "If cancellation is made 30 days or more before the date of travel, 25% of the total tour cost will be charged as cancellation fees.\nIf cancellation is made 15 to 30 days before the date of travel, 50% of the total tour cost will be charged as cancellation fees.\nIf cancellation is made 0 to 15 days before the date of travel, 100% of the total tour cost will be charged as cancellation fees.\nCancellation requests must be submitted through the official booking channel.\nIn case of unforeseen weather conditions, government restrictions, road closures, union issues, or other circumstances beyond human control, certain activities may be cancelled.",
            ],
            [
                'title' => 'Payment Policy',
                'content' => "A minimum advance payment may be required to confirm your booking.\n100% of the total tour cost should be paid at least 30 days before the date of travel.\nBookings made within 30 days of travel may require full payment at the time of confirmation.\nAll payments must be made through the approved payment methods.",
            ],
            [
                'title' => 'Booking Policy',
                'content' => "All bookings are subject to availability and confirmation.\nCustomers must provide accurate contact and traveller information while making a booking.\nAny changes to the booking after confirmation may be subject to additional charges.\nValid identification documents may be required.\nHotel and activity availability is subject to confirmation.\nSpecial requests are subject to availability.",
            ],
            [
                'title' => 'Travel Documents',
                'content' => "Travellers are responsible for carrying all necessary documents during the trip.\nValid government-issued identification.\nRequired permits for restricted areas.\nHotel and booking vouchers.\nAny additional documents required by local authorities.\nTravellers should keep both physical and digital copies of important documents.",
            ],
            [
                'title' => 'Hotel Policy',
                'content' => "Hotel check-in and check-out timings are subject to the property's standard policies.\nEarly check-in is subject to availability.\nLate check-out may incur additional charges.\nRoom upgrades are subject to availability and additional charges.\nHotel preferences cannot always be guaranteed.",
            ],
            [
                'title' => 'Travel & Weather Policy',
                'content' => "Ladakh is a high-altitude destination and weather conditions can change quickly.\nRoad conditions, snowfall, landslides, heavy rainfall, or other natural events may affect the planned itinerary.\nRoutes may be changed for safety reasons.\nActivities may be rescheduled depending on weather conditions.\nAlternative arrangements may be provided whenever possible.\nAdditional costs caused by unforeseen circumstances may apply.",
            ],
        ];
    }

    /**
     * Copies a demo image from public/assets into storage/app/public/tourpackages/demo
     * so it resolves the same way an admin-uploaded image would (asset('storage/...')).
     */
    private function copyDemoImage(string $publicRelativePath, string $label): ?string
    {
        $source = public_path($publicRelativePath);

        if (!File::exists($source)) {
            return null;
        }

        $destinationDir = storage_path('app/public/tourpackages/demo');
        File::ensureDirectoryExists($destinationDir);

        $filename = $label . '-' . Str::random(6) . '.' . File::extension($source);
        File::copy($source, $destinationDir . '/' . $filename);

        return 'tourpackages/demo/' . $filename;
    }
}