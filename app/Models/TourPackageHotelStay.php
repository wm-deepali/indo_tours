<?php
// app/Models/TourPackageHotelStay.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourPackageHotelStay extends Model
{
    protected $fillable = [
        'tour_package_id', 'hotel_id', 'day_label', 'title',
        'check_in', 'check_out',
        'breakfast_included', 'lunch_included', 'dinner_included', 'sort_order',
    ];

    protected $casts = [
        'breakfast_included' => 'boolean',
        'lunch_included' => 'boolean',
        'dinner_included' => 'boolean',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
}