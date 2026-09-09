<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionCarryGroup extends Model
{
    protected $fillable = [
        'attraction_id',
        'title',
        'items',
        'sort_order',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }
}