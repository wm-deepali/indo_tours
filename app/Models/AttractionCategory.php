<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'status',
        'sort_order',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Relation to Attraction (many-to-many) will be added when we wire this in.
}