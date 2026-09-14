<?php
// app/Models/ActivityPackage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityPackage extends Model
{
    protected $fillable = [
        'activity_id',
        'title',
        'duration_label',
        'description',
        'includes',
        'old_price',
        'new_price',
        'save_text',
        'is_recommended',
        'sort_order',
    ];

    protected $casts = [
        'includes' => 'array',
        'old_price' => 'float',
        'new_price' => 'float',
        'is_recommended' => 'boolean',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}