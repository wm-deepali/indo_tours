<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\City;

class LocationController extends Controller
{
    public function getStates($countryId)
    {
        return State::where('country_id', $countryId)
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get(['id', 'name']);
    }

    public function getCities($stateId)
    {
        return City::where('state_id', $stateId)
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get(['id', 'name']);
    }
}