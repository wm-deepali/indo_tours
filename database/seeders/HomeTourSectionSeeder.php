<?php
// database/seeders/HomeTourSectionSeeder.php

namespace Database\Seeders;

use App\Models\HomeTourSection;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class HomeTourSectionSeeder extends Seeder
{
    public function run(): void
    {
        $description = 'Choose from our handpicked travel experiences, designed to make every journey unforgettable.';

        $sections = [
            ['highlight' => 'Maldives',     'placement' => 'after_banner',  'style_class' => 'home-secA'],
            ['highlight' => 'Japan',        'placement' => 'after_promo',   'style_class' => 'home-secC'],
            ['highlight' => 'Dubai',        'placement' => 'after_slider',  'style_class' => 'home-secA'],
            ['highlight' => 'Thailand',     'placement' => 'after_slider',  'style_class' => 'home-secG'],
            ['highlight' => 'Bhutan',       'placement' => 'after_support', 'style_class' => 'home-secA'],
            ['highlight' => 'Spiti Valley', 'placement' => 'after_support', 'style_class' => 'home-secG home-secJ'],
        ];

        foreach ($sections as $i => $s) {
            // Sub-category ko highlight ke naam se match karta hai; na mile toh null (= saare packages)
            $subCategoryId = SubCategory::where('name', 'like', $s['highlight'])->value('id');

            HomeTourSection::updateOrCreate(
                ['title' => 'Tours In', 'highlight' => $s['highlight']],
                [
                    'description'     => $description,
                    'sub_category_id' => $subCategoryId,
                    'limit'           => 8,
                    'view_all_url'    => null,
                    'placement'       => $s['placement'],
                    'style_class'     => $s['style_class'],
                    'sort_order'      => $i,
                    'is_active'       => true,
                ]
            );
        }
    }
}