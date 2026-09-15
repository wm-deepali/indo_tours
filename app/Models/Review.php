<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends Model
{
    protected $fillable = [
        'reviewable_id',
        'reviewable_type',
        'full_name',
        'designation',
        'photo',
        'rating',
        'review',
        'status',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    public function initials(): string
    {
        $words = preg_split('/\s+/', trim($this->full_name));
        $initials = strtoupper(substr($words[0] ?? '', 0, 1) . substr($words[1] ?? '', 0, 1));
        return $initials ?: '?';
    }
}