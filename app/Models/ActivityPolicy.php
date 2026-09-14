<?php
// app/Models/ActivityPolicy.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityPolicy extends Model
{
    protected $fillable = [
        'activity_id',
        'title',
        'points',
        'sort_order',
    ];

    protected $casts = [
        'points' => 'array',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}