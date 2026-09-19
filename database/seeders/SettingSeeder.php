<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'site_name'   => 'Indo Tours & Adventures',
                'tagline'     => 'Explore India & the World with Experts',
                'logo'        => null,   // null = layout me assets/images/logo.png fallback chalega
                'favicon'     => null,   // null = default favicon fallback

                'admin_email'      => 'admin@indotours.test',
                'support_email'    => 'support@indotours.test',
                'phone'            => '+91 12345 67890',
                'whatsapp'         => '911234567890',
                'business_address' => '123, Connaught Place, New Delhi, Delhi 110001, India',

                'footer_description' => 'Indo Tours & Adventures crafts handpicked India and international tour packages, activities and honeymoon trips with 24/7 support.',
                'footer_copyright'   => '© ' . date('Y') . ' Indo Tours & Adventures — All rights reserved.',
                'google_map_url'     => 'https://maps.google.com/?q=Connaught+Place+New+Delhi',

                'facebook'  => 'https://facebook.com/indotours',
                'instagram' => 'https://instagram.com/indotours',
                'twitter'   => 'https://x.com/indotours',
                'linkedin'  => 'https://linkedin.com/company/indotours',
                'youtube'   => 'https://youtube.com/@indotours',
                'pinterest' => 'https://pinterest.com/indotours',

                'currency'        => 'INR',
                'currency_symbol' => '₹',
                'timezone'        => 'Asia/Kolkata',

                'maintenance_mode'      => false,
                'admin_session_timeout' => 60,
            ]
        );
    }
}