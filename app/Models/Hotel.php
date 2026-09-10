<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name', 'slug', 'country_id', 'state_id', 'city_id',
        'rating', 'check_in_time', 'check_out_time',
        'short_description', 'location', 'status',
    ];

    public function galleries()
    {
        return $this->hasMany(HotelGallery::class)->orderBy('sort_order');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
