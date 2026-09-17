<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Dubai',    'subtitle' => 'Discover the places and experiences worth exploring.', 'sort_order' => 1],
            ['name' => 'Thailand', 'subtitle' => 'Discover the places and experiences worth exploring.', 'sort_order' => 2],
            ['name' => 'Bali',     'subtitle' => 'Discover the places and experiences worth exploring.', 'sort_order' => 3],
            ['name' => 'India',    'subtitle' => 'Discover the places and experiences worth exploring.', 'sort_order' => 4],
        ];

        foreach ($categories as $data) {
            BlogCategory::firstOrCreate(
                ['name' => $data['name']],
                [
                    'slug'       => BlogCategory::uniqueSlug($data['name']),
                    'subtitle'   => $data['subtitle'],
                    'sort_order' => $data['sort_order'],
                    'status'     => 1,
                ]
            );
        }
    }
}