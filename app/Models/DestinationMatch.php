<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DestinationMatch extends Model
{
    protected $fillable = [
        'destination_id',
        'icon',
        'want',
        'offer_text',
        'sort_order',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}