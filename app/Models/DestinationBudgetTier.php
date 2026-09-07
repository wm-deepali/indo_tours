<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DestinationBudgetTier extends Model
{
    protected $fillable = [
        'destination_id',
        'name',
        'price_from',
        'price_to',
        'price_suffix',
        'description',
        'is_featured',
        'badge_text',
        'sort_order',
    ];
    protected $casts = ['is_featured' => 'boolean'];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}
