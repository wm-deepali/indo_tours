<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\SeoSetting;



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
    public function boot()
    {

        View::composer('*', function ($view) {
            $view->with('footerCategories', Category::where('status', 'published')->orderBy('name')->get());
        });

        View::composer('*', function ($view) {
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

            $view->with('seo', $pageKey ? SeoSetting::forPage($pageKey) : null);
        });

    }
}
