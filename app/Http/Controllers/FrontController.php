<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Review;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Attraction;
use App\Models\ContactPage;
use App\Models\TourPackage;
use App\Models\SubCategory;
use App\Models\Destination;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Models\ActivityCategory;
use App\Models\ContactSubmission;
use App\Models\TourPackageEnquiry;
use App\Models\AttractionCategory;
use App\Models\LandingPageActivity;
use App\Models\LandingPageAttraction;
use App\Models\LandingPageDestination;
use App\Models\Page;

class FrontController extends Controller
{
    /**
     * Map of short type keys (used in forms/requests) to model classes.
     * Keep this in sync with Admin\ReviewController::reviewableTypes().
     */
    protected function reviewableTypes(): array
    {
        return [
            'tour_package' => TourPackage::class,
            'activity' => Activity::class,
            'destination' => Destination::class,
            'attraction' => Attraction::class,
        ];
    }

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

        // Distinct activities covered by this category's tour packages
        $activities = Activity::whereHas('tourPackages', function ($query) use ($subCategoryIds) {
            $query->whereIn('sub_category_id', $subCategoryIds)
                ->where('status', 'published');
        })->get();

        // Top reviews for tour packages under this category
        $reviews = Review::with('reviewable')
            ->where('reviewable_type', TourPackage::class)
            ->whereIn('reviewable_id', function ($query) use ($subCategoryIds) {
                $query->select('id')->from('tour_packages')
                    ->whereIn('sub_category_id', $subCategoryIds)
                    ->where('status', 'published');
            })
            ->where('status', 'published')
            ->orderByDesc('rating')
            ->latest()
            ->take(9)
            ->get();

        return view('front-pages.category-detail', compact(
            'category',
            'destinations',
            'attractions',
            'activities',
            'reviews'
        ));
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

        // Distinct destinations covered by this sub-category's tour packages
        $destinations = Destination::whereHas('tourPackages', function ($query) use ($subCategoryId) {
            $query->where('sub_category_id', $subCategoryId)
                ->where('status', 'published');
        })->get();

        // Distinct attractions covered by this sub-category's tour packages
        $attractions = Attraction::whereHas('tourPackages', function ($query) use ($subCategoryId) {
            $query->where('sub_category_id', $subCategoryId)
                ->where('status', 'published');
        })->get();

        // Distinct activities covered by this sub-category's tour packages
        $activities = Activity::whereHas('tourPackages', function ($query) use ($subCategoryId) {
            $query->where('sub_category_id', $subCategoryId)
                ->where('status', 'published');
        })->get();

        // Top reviews for tour packages under this sub-category
        $reviews = Review::with('reviewable')
            ->where('reviewable_type', TourPackage::class)
            ->whereIn('reviewable_id', function ($query) use ($subCategoryId) {
                $query->select('id')->from('tour_packages')
                    ->where('sub_category_id', $subCategoryId)
                    ->where('status', 'published');
            })
            ->where('status', 'published')
            ->orderByDesc('rating')
            ->latest()
            ->take(9)
            ->get();

        return view('front-pages.subcategory-detail', compact(
            'subCategory',
            'destinations',
            'attractions',
            'activities',
            'reviews'
        ));
    }

    public function tourPackageDetail(string $slug)
    {
        $tourPackage = TourPackage::where('slug', $slug)
            ->where('status', 'published')
            ->with([
                'subCategory.category',
                'country',
                'state',
                'city',
                'amenities',
                'durationOptions',
                'routeStops',
                'highlights',
                'itineraryDays',
                'hotelStays.hotel.galleries',
                'includes',
                'excludes',
                'policies',
                'faqs',
                'reviews', // uses TourPackage::reviews() morphMany, already scoped to published
                'destinations',
                'attractions',
                'activities',
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

        $landingPage = LandingPageDestination::firstOrCreate([]);

        $featuredPackages = TourPackage::with(['country', 'state', 'city'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('status', 'published')
            ->where('featured', true)
            ->latest()
            ->take(8)
            ->get();

        $destinations = Destination::published()
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('front-pages.destination', compact('destinations', 'landingPage', 'featuredPackages'));
    }

    public function destinationDetail($slug)
    {
        $destination = Destination::with([
            'galleries',
            'country',
            'state',
            'city',
            'tourPackages' => fn($query) => $query->where('status', 'published')->latest(),
        ])->where('slug', $slug)->firstOrFail();

        // Related packages: tour packages belonging to OTHER destinations
        // in the same state (fallback to same country), excluding this destination's own packages
        $relatedPackages = TourPackage::where('status', 'published')
            ->whereHas('destinations', function ($query) use ($destination) {
                $query->where('destinations.id', '!=', $destination->id);

                if ($destination->state_id) {
                    $query->where('state_id', $destination->state_id);
                } elseif ($destination->country_id) {
                    $query->where('country_id', $destination->country_id);
                }
            })
            ->latest()
            ->take(8)
            ->get();

        return view('front-pages.destination-detail', compact('destination', 'relatedPackages'));
    }

    public function attractions(Request $request)
    {
        $landingPage = LandingPageAttraction::firstOrCreate([]);

        $featuredAttractions = Attraction::with(['country', 'state', 'city'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $destinations = Destination::published()
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $allDestinations = Destination::published()
            ->orderBy('name')
            ->get();

        $categories = AttractionCategory::published()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(6)
            ->get();

        $mustVisitAttractions = Attraction::with(['country', 'state', 'city'])
            ->where('status', 'published')
            ->where('is_must_visit', true)
            ->latest()
            ->take(6)
            ->get();

        return view('front-pages.attractions', compact(
            'landingPage',
            'featuredAttractions',
            'destinations',
            'allDestinations',
            'categories',
            'mustVisitAttractions'
        ));
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
            'tourPackages' => fn($query) => $query->where('status', 'published')->latest(),
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

        // Related packages: tour packages tied to the related (nearby) attractions,
        // excluding any package already shown in this attraction's own package list
        $ownPackageIds = $attraction->tourPackages->pluck('id');

        $relatedPackages = TourPackage::where('status', 'published')
            ->whereHas('attractions', function ($query) use ($relatedAttractions) {
                $query->whereIn('attractions.id', $relatedAttractions->pluck('id'));
            })
            ->whereNotIn('id', $ownPackageIds)
            ->latest()
            ->take(8)
            ->get();

        return view('front-pages.attraction-detail', compact(
            'attraction',
            'relatedAttractions',
            'relatedPackages'
        ));
    }

    public function activities(Request $request)
    {
        $landingPage = LandingPageActivity::first();

        $relatedDestinations = collect();
        if ($landingPage && !empty($landingPage->related_destination_ids)) {
            $attractionsById = Destination::whereIn('id', $landingPage->related_destination_ids)
                ->where('status', 'published')
                ->get()
                ->keyBy('id');

            // preserve the admin-chosen order, since whereIn() doesn't guarantee it
            $relatedDestinations = collect($landingPage->related_destination_ids)
                ->map(fn($id) => $attractionsById->get($id))
                ->filter();
        }

        $categories = ActivityCategory::where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $allActivities = Activity::with(['category', 'country', 'state', 'city', 'packages'])
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $indianActivities = $allActivities->filter(function ($activity) {
            return $activity->country && $activity->country->name === 'India';
        })->values();

        $internationalActivities = $allActivities->filter(function ($activity) {
            return !$activity->country || $activity->country->name !== 'India';
        })->values();

        $featuredActivities = Activity::with(['category', 'country', 'state', 'city', 'packages'])
            ->where('status', 'published')
            ->where('featured', true)
            ->orderBy('sort_order')
            ->latest()
            ->take(8)
            ->get();

        return view('front-pages.activities', compact('landingPage', 'relatedDestinations', 'categories', 'indianActivities', 'internationalActivities', 'featuredActivities'));
    }

    public function activitiesDetail($slug)
    {
        $activity = Activity::with([
            'country',
            'city',
            'packages',
            'policies',
            'faqs',
            'reviews',
            'attractions.city',
        ])->where('slug', $slug)->firstOrFail();

        // Related activities: prefer same city, fall back to same country
        $relatedQuery = Activity::where('id', '!=', $activity->id);

        if ($activity->city_id) {
            $relatedQuery->where('city_id', $activity->city_id);
        } elseif ($activity->country_id) {
            $relatedQuery->where('country_id', $activity->country_id);
        }

        $relatedActivities = $relatedQuery->latest()->take(8)->get();

        // If same-city search came up short, top it up from the same country
        if ($relatedActivities->count() < 4 && $activity->country_id) {
            $more = Activity::where('country_id', $activity->country_id)
                ->whereNotIn('id', $relatedActivities->pluck('id'))
                ->latest()
                ->take(8 - $relatedActivities->count())
                ->get();

            $relatedActivities = $relatedActivities->concat($more);
        }

        return view('front-pages.activity-detail', compact('activity', 'relatedActivities'));
    }

    public function reviewStore(Request $request)
    {
        $types = $this->reviewableTypes();

        $validated = $request->validate([
            'reviewable_type' => 'required|in:' . implode(',', array_keys($types)),
            'reviewable_id' => 'required|integer',
            'full_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
            'photo' => 'nullable|image|max:1024',
        ]);

        $modelClass = $types[$validated['reviewable_type']];

        // Confirm the entity actually exists and is published before attaching a review to it
        if (!$modelClass::where('id', $validated['reviewable_id'])->where('status', 'published')->exists()) {
            $message = 'The item you are reviewing could not be found.';

            return $request->wantsJson()
                ? response()->json(['success' => false, 'message' => $message], 422)
                : back()->withErrors(['reviewable_id' => $message]);
        }

        $data = [
            'reviewable_type' => $modelClass,
            'reviewable_id' => $validated['reviewable_id'],
            'full_name' => $validated['full_name'],
            'designation' => $validated['designation'] ?? null,
            'rating' => $validated['rating'],
            'review' => $validated['review'],
            'status' => 'draft', // public submissions go to moderation queue, not straight to published
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('reviews/photos', 'public');
        }

        Review::create($data);

        $message = 'Thanks for sharing your experience! Your review will appear after a quick review.';

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
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



    public function blogs()
    {
        // Categories with their published blogs (only categories that actually have posts)
        $categories = BlogCategory::active()
            ->ordered()
            ->with([
                'blogs' => function ($q) {
                    $q->published()->orderByDesc('published_at')->take(8);
                }
            ])
            ->get()
            ->filter(fn($category) => $category->blogs->isNotEmpty())
            ->values();

        // Latest 4 blogs overall, for the "Latest Travel Stories" section
        $latestBlogs = Blog::published()
            ->with('category')
            ->ordered()
            ->take(4)
            ->get();

        $destinations = Destination::published()
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(5)
            ->get();

        return view('front-pages.blogs', compact('categories', 'latestBlogs', 'destinations'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::with([
            'comments',
            'category',
            'author',
            'destinations',
            'attractions',
            'activities',
            'tourPackages' => function ($q) {
                $q->withAvg('reviews', 'rating')
                    ->withCount('reviews');
            },
        ])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        // increment views (simple counter — no session/IP dedup for now)
        $blog->increment('views');

        $popularStories = Blog::published()
            ->where('id', '!=', $blog->id)
            ->orderByDesc('views')
            ->take(3)
            ->get();

        return view('front-pages.blog-detail', compact('blog', 'popularStories'));
    }

    public function storeComment(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:2000',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('comments', 'public');
        }

        $blog->comments()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'comment' => $validated['comment'],
            'photo' => $validated['photo'] ?? null,
            'status' => 'pending', // change to 'approved' if you don't want moderation
        ]);

        return back()->with('success', 'Thanks! Your comment has been submitted for review.');
    }

    public function pageDetail(Page $page)
    {
        abort_unless($page->is_active, 404);

        $fallbackDescription = \Illuminate\Support\Str::limit(strip_tags($page->content), 160);

        return view('front-pages.pages', compact('page', 'fallbackDescription'));
    }

    public function contact()
    {
        $contactPage = ContactPage::first();

        return view('front-pages.contact', compact('contactPage'));
    }

    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:2000',
            'newsletter' => 'nullable|boolean',
        ]);

        ContactSubmission::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
            'newsletter' => $request->boolean('newsletter'),
        ]);

            return redirect()->route('thankyou', ['context' => 'contact']);

    }

    public function thankYou(Request $request)
    {
        $context = $request->query('context');

        $copy = match ($context) {
            'contact' => [
                'heading' => 'Thank You!',
                'message' => "Thank you for reaching out to IND Tour Adventure. We've received your message and our travel expert will get in touch with you shortly.",
            ],
            'enquiry' => [
                'heading' => 'Enquiry Received!',
                'message' => "Thank you for your enquiry. Our travel expert will get in touch with you shortly to help plan your trip.",
            ],
            'newsletter' => [
                'heading' => "You're Subscribed!",
                'message' => "Thanks for signing up — you'll now receive our latest offers and travel updates straight to your inbox.",
            ],
            default => [
                'heading' => 'Thank You!',
                'message' => "Thank you for reaching out to IND Tour Adventure. We've received your enquiry and our travel expert will get in touch with you shortly.",
            ],
        };

        return view('front-pages.thank-you', $copy);
    }

}