<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'status',
    ];

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function destinations(): HasMany
    {
        return $this->hasMany(Destination::class);
    }
}