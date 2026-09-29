<?php
// app/Models/HomeTourSection.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeTourSection extends Model
{
    public const PLACEMENTS = [
        'after_banner'  => 'After Banner',
        'after_promo'   => 'After Promo Grid',
        'after_slider'  => 'After Home Slider',
        'after_support' => 'After Support Section',
    ];

    protected $fillable = [
        'title', 'highlight', 'description', 'sub_category_id', 'limit',
        'view_all_url', 'placement', 'style_class', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'limit'     => 'integer',
    ];

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}