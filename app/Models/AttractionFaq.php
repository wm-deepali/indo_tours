<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionFaq extends Model
{
    protected $fillable = [
        'attraction_id',
        'question',
        'answer',
        'sort_order',
    ];

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }
}