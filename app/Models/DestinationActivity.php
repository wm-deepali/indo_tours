<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationActivity extends Model
{
    protected $fillable = ['destination_id', 'image', 'tag', 'title', 'description', 'is_featured', 'sort_order'];
    protected $casts = ['is_featured' => 'boolean'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}