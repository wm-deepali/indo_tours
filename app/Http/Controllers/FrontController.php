<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Attraction;

class FrontController extends Controller
{

    public function home(Request $request)
    {
        return view('front-pages.home');
    }


    public function destinations(Request $request)
    {
        $destinations = Destination::published()
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('front-pages.destination', compact('destinations'));
    }

    public function destinationDetail(Destination $destination)
    {
        $destination->load('galleries', 'country', 'state', 'city');

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

    public function attractionDetail(Attraction $attraction)
    {
        abort_unless($attraction->status === 'published', 404);

        $attraction->load([
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
        ]);

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