<?php
// app/Models/TourPackageEnquiry.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourPackageEnquiry extends Model
{
    protected $fillable = [
        'tour_package_id',
        'full_name',
        'email',
        'phone',
        'travel_date',
        'traveller_count',
        'message',
        'status',
    ];

    public function tourPackage(): BelongsTo
    {
        return $this->belongsTo(TourPackage::class);
    }
}