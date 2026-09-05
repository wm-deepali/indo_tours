<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DestinationPlace extends Model
{
    protected $fillable = [
        'destination_id',
        'image',
        'name',
        'description',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}