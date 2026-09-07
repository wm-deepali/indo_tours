<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DestinationJourneyDay extends Model
{
    protected $fillable = [
        'destination_id', 'day_number', 'title', 'image',
        'flow_text', 'stay_text', 'food_text', 'is_departure', 'sort_order',
    ];
    protected $casts = ['is_departure' => 'boolean'];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}
