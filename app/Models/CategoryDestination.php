<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryDestination extends Model
{
    protected $fillable = ['category_id', 'destination_id', 'sort_order'];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}
