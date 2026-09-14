<?php
// app/Models/ActivityFaq.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityFaq extends Model
{
    protected $fillable = [
        'activity_id',
        'question',
        'answer',
        'sort_order',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}