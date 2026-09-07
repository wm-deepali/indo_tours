<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DestinationRoute extends Model
{
    protected $fillable = ['destination_id', 'days', 'label', 'subtitle', 'path', 'note', 'sort_order'];
    protected $casts = ['path' => 'array'];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}

