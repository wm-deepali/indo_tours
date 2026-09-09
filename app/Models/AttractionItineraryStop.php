<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionItineraryStop extends Model
{
    protected $fillable = ['attraction_itinerary_id', 'stop_name', 'sort_order'];

    public function itinerary()
    {
        return $this->belongsTo(AttractionItinerary::class, 'attraction_itinerary_id');
    }
}