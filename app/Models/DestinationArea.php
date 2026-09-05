<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DestinationArea extends Model
{
    protected $fillable = [
        'destination_id',
        'image',
        'name',
        'tag',
        'stay_duration',
        'why_text',
        'nearby_text',
        'sort_order',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}