<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Category;
use App\Models\SeoSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('footerPages', Cache::remember(
                'footer_pages',
                now()->addHour(),
                fn () => Page::where('is_active', true)->orderBy('title')->get()
            ));

            $view->with('footerCategories', Cache::remember(
                'footer_categories',
                now()->addHour(),
                fn () => Category::where('status', 'published')->orderBy('name')->get()
            ));

            $routeName = optional(Route::getCurrentRoute())->getName();

            $map = [
                'home' => 'home',
                'destinations' => 'destination_listing',
                'attractions' => 'attraction_listing',
                'activities' => 'activities_listing',
                'blogs' => 'blog_listing',
                // detail pages (destination.show, tourpackage.show, etc.)
                // pull their own meta from the model itself, not this table
            ];

            $pageKey = $map[$routeName] ?? null;

            $view->with('seo', $pageKey
                ? Cache::remember("seo_setting_{$pageKey}", now()->addHour(), fn () => SeoSetting::forPage($pageKey))
                : null);
        });
    }
}