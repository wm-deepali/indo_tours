<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/DestinationBanner.php
class DestinationBanner extends Model
{
    protected $fillable = [
        'destination_id', 'badge_text', 'heading', 'description', 'perks',
        'image', 'cta_primary_text', 'cta_primary_link', 'cta_secondary_text',
    ];
    protected $casts = ['perks' => 'array'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}


