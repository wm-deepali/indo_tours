<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionExperience extends Model
{
    protected $fillable = ['attraction_id', 'image', 'title', 'description', 'duration_text', 'sort_order'];

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }
}