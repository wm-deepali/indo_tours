<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Attraction;
use App\Models\TourPackage;
use App\Models\TourPackageReview;
use App\Models\TourPackageEnquiry;

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
            'subCategories' => fn($query) => $query->where('status', 'published'),
        ])->where('slug', $slug)->firstOrFail();

        $subCategoryIds = $category->subCategories->pluck('id');

        // Distinct destinations covered by this category's tour packages
        $destinations = Destination::whereHas('tourPackages', function ($query) use ($subCategoryIds) {
            $query->whereIn('sub_category_id', $subCategoryIds)
                ->where('status', 'published');
        })->get();

        // Distinct attractions covered by this category's tour packages
        $attractions = Attraction::whereHas('tourPackages', function ($query) use ($subCategoryIds) {
            $query->whereIn('sub_category_id', $subCategoryIds)
                ->where('status', 'published');
        })->get();

        return view('front-pages.category-detail', compact('category', 'destinations', 'attractions'));
    }

    public function subcategoryDetail($slug)
    {
        $subCategory = SubCategory::with([
            'highlights',
            'ctaPerks',
            'faqs',
            'category',
            'tourPackages' => fn($query) => $query->where('status', 'published')->latest(),
        ])
            ->where('slug', $slug)
            ->firstOrFail();

$subCategoryId = $subCategory->id;

 // Distinct destinations covered by this category's tour packages
        $destinations = Destination::whereHas('tourPackages', function ($query) use ($subCategoryId) {
            $query->where('sub_category_id', $subCategoryId)
                ->where('status', 'published');
        })->get();

        // Distinct attractions covered by this category's tour packages
        $attractions = Attraction::whereHas('tourPackages', function ($query) use ($subCategoryId) {
            $query->where('sub_category_id', $subCategoryId)
                ->where('status', 'published');
        })->get();
        
        return view('front-pages.subcategory-detail', compact('subCategory','destinations', 'attractions'));
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
                'reviews'
            ])
            ->firstOrFail();

        $relatedPackages = TourPackage::where('status', 'published')
            ->where('sub_category_id', $tourPackage->sub_category_id)
            ->where('id', '!=', $tourPackage->id)
            ->latest()
            ->take(8)
            ->get();

        return view('front-pages.package-detail', compact('tourPackage', 'relatedPackages'));
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


    public function activities(Request $request)
    {
        return view('front-pages.attractions');
    }

    public function activitiesDetail($slug)
    {
        $activity = Activity::with([
            'country',
            'packages',
            'policies',
            'faqs'
        ])->where('slug', $slug)->firstOrFail();

        return view('front-pages.activity-detail', compact('activity'));
    }


    public function reviewStore(Request $request)
    {
        $validated = $request->validate([
            'tour_package_id' => 'required|exists:tour_packages,id',
            'full_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
            'photo' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('reviews/photos', 'public');
        }

        TourPackageReview::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thanks for sharing your experience!',
            ]);
        }

        return back()->with('success', 'Thanks for sharing your experience!');
    }

    public function enquiryStore(Request $request)
    {
        $validated = $request->validate([
            'tour_package_id' => 'required|exists:tour_packages,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'dates' => 'nullable|string|max:100',
            'traveller_count' => 'required|integer|min:1',
            'message' => 'nullable|string|max:1000',
        ]);

        TourPackageEnquiry::create([
            'tour_package_id' => $validated['tour_package_id'],
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'travel_date' => $validated['dates'] ?? null,
            'traveller_count' => $validated['traveller_count'],
            'message' => $validated['message'] ?? null,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thanks! Our team will get in touch with you shortly.',
            ]);
        }

        return back()->with('success', 'Thanks! Our team will get in touch with you shortly.');
    }

}