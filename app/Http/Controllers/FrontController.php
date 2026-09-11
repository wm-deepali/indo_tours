<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Attraction;
use App\Models\TourPackage;

class FrontController extends Controller
{

    public function home(Request $request)
    {
        return view('front-pages.home');
    }

    public function categoryDetail($slug)
    {
        $category = Category::with([
            'facts',
            'ctaPerks',
            'faqs',
            'destinationLinks.destination',
            'attractionLinks.attraction',
            'subCategories' => fn($query) => $query->where('status', 'published'),
        ])->where('slug', $slug)->firstOrFail();

        return view('front-pages.category-detail', compact('category'));
    }

    public function subcategoryDetail($slug)
    {
        $subCategory = SubCategory::with([
            'highlights',
            'ctaPerks',
            'faqs',
            'category',
            'destinationLinks.destination',
            'attractionLinks.attraction',
            'tourPackages' => fn($query) => $query->where('status', 'published')->latest(),
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('front-pages.subcategory-detail', compact('subCategory'));
    }

    // FrontController.php
    public function tourPackageDetail(string $slug)
    {
        $tourPackage = TourPackage::where('slug', $slug)
            ->where('status', 'published')
            ->with([
                'subCategory',
                'country',
                'state',
                'city',
                'features',
                'durationOptions',
                'routeStops',
                'highlights',
                'itineraryDays',
                'hotelStays.hotel',
                'includes',
                'excludes',
                'policies',
                'faqs',
            ])
            ->firstOrFail();

        return view('package-detail', compact('tourPackage'));
    }

    public function destinations(Request $request)
    {
        $destinations = Destination::published()
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('front-pages.destination', compact('destinations'));
    }

    public function destinationDetail($slug)
    {
        $destination = Destination::with(['galleries', 'country', 'state', 'city'])->where('slug', $slug)->firstOrFail();

        return view('front-pages.destination-detail', compact('destination'));
    }

    public function attractions(Request $request)
    {
        $mustVisitAttractions = Attraction::with(['country', 'state', 'city'])
            ->where('status', 'published')
            ->orderByDesc('rating')
            ->latest()
            ->take(6)
            ->get();

        return view('front-pages.attractions', compact('mustVisitAttractions'));
    }

    public function attractionDetail($slug)
    {
        $attraction = Attraction::with([
            'galleries',
            'highlights',
            'experiences',
            'places',
            'itineraries.stops',
            'seasons',
            'transports',
            'budgetTiers',
            'carryGroups',
            'faqs',
            'country',
            'state',
            'city',
        ])->where('slug', $slug)->firstOrFail();

        $relatedAttractions = Attraction::where('status', 'published')
            ->where('id', '!=', $attraction->id)
            ->with('country')
            ->when($attraction->country_id, function ($query) use ($attraction) {
                $query->orderByRaw('country_id = ? DESC', [$attraction->country_id]);
            })
            ->orderBy('sort_order')
            ->latest()
            ->take(8)
            ->get();

        return view('front-pages.attraction-detail', compact('attraction', 'relatedAttractions'));
    }

}