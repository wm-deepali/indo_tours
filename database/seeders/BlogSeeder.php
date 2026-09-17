<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Attraction;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Destination;
use App\Models\TourPackage;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::first();

        $posts = [
            [
                'category' => 'Dubai',
                'title' => 'These Unmissable Experiences Await You in Dubai',
                'tag' => 'Adventure',
                'short_description' => 'From desert safaris to skyline views, discover the moments that make every trip unforgettable.',
                'content' => $this->sampleContent(),
            ],
            [
                'category' => 'India',
                'title' => 'Discover Manali: The Perfect Mountain Escape for Your Next Trip',
                'tag' => 'Travel Guide',
                'short_description' => 'Scenic mountains and exciting outdoor experiences await in Manali.',
                'content' => $this->sampleContent(),
            ],
            [
                'category' => 'India',
                'title' => 'Kashmir Travel Guide: Explore the Valley of Lakes and Mountains',
                'tag' => 'Travel Guide',
                'short_description' => 'Beautiful valleys, lakes and mountain experiences in Kashmir.',
                'content' => $this->sampleContent(),
            ],
        ];

        foreach ($posts as $post) {
            $category = BlogCategory::where('name', $post['category'])->first();
            if (!$category) {
                continue;
            }

            $blog = Blog::firstOrCreate(
                ['title' => $post['title']],
                [
                    'blog_category_id' => $category->id,
                    'author_id' => $author?->id,
                    'slug' => Blog::uniqueSlug($post['title']),
                    'tag' => $post['tag'],
                    'short_description' => $post['short_description'],
                    'content' => $post['content'],
                    'views' => rand(500, 20000),
                    'published_at' => now()->subDays(rand(1, 60)),
                    'status' => 'published',

                    'destination_heading' => 'Explore Popular Destinations',
                    'destination_description' => 'Handpicked destinations worth adding to your next trip.',

                    'tour_package_heading' => 'Popular <span>Tour Packages</span>',
                    'tour_package_description' => 'Handpicked itineraries loved by travellers — pick yours and get going.',

                    'h1' => $post['title'],
                    'meta_title' => $post['title'],
                    'meta_description' => $post['short_description'],
                ]
            );

            // attach a few related items if those tables/models have data
            if (class_exists(Destination::class)) {
                $destinationIds = Destination::inRandomOrder()->take(2)->pluck('id');
                $blog->destinations()->sync($destinationIds->mapWithKeys(fn($id, $i) => [$id => ['sort_order' => $i]]));
            }

            if (class_exists(Attraction::class)) {
                $attractionIds = Attraction::inRandomOrder()->take(2)->pluck('id');
                $blog->attractions()->sync($attractionIds->mapWithKeys(fn($id, $i) => [$id => ['sort_order' => $i]]));
            }

            if (class_exists(Activity::class)) {
                $activityIds = Activity::inRandomOrder()->take(2)->pluck('id');
                $blog->activities()->sync($activityIds->mapWithKeys(fn($id, $i) => [$id => ['sort_order' => $i]]));
            }

            if (class_exists(TourPackage::class)) {
                $packageIds = TourPackage::inRandomOrder()->take(3)->pluck('id');
                $blog->tourPackages()->sync($packageIds->mapWithKeys(fn($id, $i) => [$id => ['sort_order' => $i]]));
            }
        }
    }

    private function sampleContent(): string
    {
        return <<<HTML
<div class="blog-card">
              <h4>1. Explore Hidden Gems Away From the Crowds</h4>

              <p>
                Discover peaceful destinations that offer breathtaking
                landscapes, charming local communities, and unforgettable
                experiences away from the usual tourist attractions.
              </p>

              <ul>
                <li>Discover peaceful and scenic destinations</li>
                <li>Experience authentic local culture</li>
                <li>Enjoy beautiful landscapes and photography spots</li>
              </ul>

              <span> Discover Hidden Gems </span>

              <img loading="lazy" src="{{ asset('assets/images/blog/manali.jpg')}}" alt="Hidden travel destination" />
            </div>
HTML;
    }
}