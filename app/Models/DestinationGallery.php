<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DestinationGallery extends Model
{
    protected $fillable = [
        'destination_id',
        'image',
        'title',
        'subtitle',
        'sort_order',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}