<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionGallery extends Model
{
    protected $fillable = ['attraction_id', 'image', 'title', 'subtitle', 'sort_order'];

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }
}