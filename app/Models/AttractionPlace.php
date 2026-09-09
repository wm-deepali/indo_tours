<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionPlace extends Model
{
    protected $fillable = ['attraction_id', 'image', 'tag', 'title', 'description', 'button_text', 'sort_order'];

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }
}