<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DestinationBudgetBreakdown extends Model
{
    protected $fillable = ['destination_id', 'label', 'percent', 'sort_order'];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}