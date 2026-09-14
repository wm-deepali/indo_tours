<?php
// app/Models/TourPackageReview.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourPackageReview extends Model
{
    protected $fillable = [
        'tour_package_id',
        'full_name',
        'designation',
        'photo',
        'rating',
        'review',
        'status',
    ];

    public function tourPackage(): BelongsTo
    {
        return $this->belongsTo(TourPackage::class);
    }

    public function initials(): string
    {
        $words = preg_split('/\s+/', trim($this->full_name));
        $initials = strtoupper(substr($words[0] ?? '', 0, 1) . substr($words[1] ?? '', 0, 1));
        return $initials ?: '?';
    }
}