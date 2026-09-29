<?php
// app/Models/QuickEnquiry.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickEnquiry extends Model
{
    protected $fillable = [
        'full_name', 'email', 'country_code', 'phone', 'travel_dates',
        'traveller_count', 'message', 'enquiry_type', 'enquiry_for',
        'source_url', 'ip_address', 'status',
    ];

    protected $casts = [
        'traveller_count' => 'integer',
    ];
}