<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionHighlight extends Model
{
    protected $fillable = ['attraction_id', 'icon', 'title', 'description', 'sort_order'];

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }
}