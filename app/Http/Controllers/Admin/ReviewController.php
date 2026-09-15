<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Attraction;
use App\Models\Destination;
use App\Models\Review;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Map of short type keys (used in the URL/form) to model classes.
     * Add Destination/Attraction here once those models are ready for reviews.
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

    public function index(Request $request)
    {
        $types = $this->reviewableTypes();

        $query = Review::with('reviewable')->latest();

        if ($request->filled('type') && isset($types[$request->type])) {
            $query->where('reviewable_type', $types[$request->type]);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reviews = $query->paginate(15)->withQueryString();

        return view('admin.review.index', compact('reviews', 'types'));
    }

    public function create()
    {
        $types = $this->reviewableTypes();

        return view('admin.review.create', compact('types'));
    }

    public function store(Request $request)
    {
        $types = $this->reviewableTypes();

        $validated = $request->validate([
            'reviewable_type' => 'required|in:' . implode(',', array_keys($types)),
            'reviewable_id' => 'required|integer',
            'full_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'status' => 'required|in:draft,published,unpublished',
        ]);

        $modelClass = $types[$validated['reviewable_type']];

        // Confirm the chosen entity actually exists before attaching the review to it
        if (!$modelClass::where('id', $validated['reviewable_id'])->exists()) {
            return back()->withInput()->withErrors(['reviewable_id' => 'Selected item was not found.']);
        }

        $data = [
            'reviewable_type' => $modelClass,
            'reviewable_id' => $validated['reviewable_id'],
            'full_name' => $validated['full_name'],
            'designation' => $validated['designation'] ?? null,
            'rating' => $validated['rating'],
            'review' => $validated['review'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('reviews', 'public');
        }

        Review::create($data);

        return redirect()->route('admin.reviews.index')->with('success', 'Review added successfully.');
    }

    public function edit(Review $review)
    {
        $types = $this->reviewableTypes();

        // Reverse-lookup the short type key from the stored FQCN
        $typeKey = array_search($review->reviewable_type, $types) ?: null;

        // Pre-load the current entity name so the dropdown can show it selected
        $currentEntity = $review->reviewable;

        return view('admin.review.edit', compact('review', 'types', 'typeKey', 'currentEntity'));
    }

    public function update(Request $request, Review $review)
    {
        $types = $this->reviewableTypes();

        $validated = $request->validate([
            'reviewable_type' => 'required|in:' . implode(',', array_keys($types)),
            'reviewable_id' => 'required|integer',
            'full_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'status' => 'required|in:draft,published,unpublished',
        ]);

        $modelClass = $types[$validated['reviewable_type']];

        if (!$modelClass::where('id', $validated['reviewable_id'])->exists()) {
            return back()->withInput()->withErrors(['reviewable_id' => 'Selected item was not found.']);
        }

        $data = [
            'reviewable_type' => $modelClass,
            'reviewable_id' => $validated['reviewable_id'],
            'full_name' => $validated['full_name'],
            'designation' => $validated['designation'] ?? null,
            'rating' => $validated['rating'],
            'review' => $validated['review'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('reviews', 'public');
        }

        $review->update($data);

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return back()->with('success', 'Review deleted successfully.');
    }

    /**
     * AJAX: return {id, name} pairs for the chosen reviewable type,
     * used to populate the "Review For" entity dropdown dynamically.
     */
    public function entitiesByType(string $type)
    {
        $types = $this->reviewableTypes();

        abort_unless(isset($types[$type]), 404);

        $modelClass = $types[$type];

        $entities = $modelClass::where('status', 'published')
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($entities);
    }
}