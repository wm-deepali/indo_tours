<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    protected $fillable = [
        'banner_image',
        'banner_heading',
        'banner_description',

        'touch_heading',
        'touch_description',
        'phone',
        'email',

        'opening_hours',
        'offices',

        'faqs_heading',
        'faqs',

        'promo_eyebrow',
        'promo_heading',
        'promo_description',
        'promo_image',
    ];

    protected $casts = [
        'opening_hours' => 'array',
        'offices' => 'array',
        'faqs' => 'array',
    ];
}