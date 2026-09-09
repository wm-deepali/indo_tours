<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionTransport extends Model
{
    protected $fillable = [
        'attraction_id',
        'mode_type',
        'mode_name',
        'mode_sub',
        'description',
        'sort_order',
    ];

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }
}