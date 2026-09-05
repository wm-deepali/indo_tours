<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;


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

}