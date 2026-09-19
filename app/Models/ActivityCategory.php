<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActivityCategory extends Model
{
    protected $guarded = [];

    protected $casts = [
        'show_in_header' => 'boolean',
    ];

    public function scopeInHeader($query)
    {
        return $query->where('show_in_header', true)
            ->where('status', 'active')
            ->orderBy('header_sort_order');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}