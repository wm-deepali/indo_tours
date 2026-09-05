<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = [
        'state_id',
        'name',
        'slug',
        'sort_order',
        'status',
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function destinations(): HasMany
    {
        return $this->hasMany(Destination::class);
    }
}