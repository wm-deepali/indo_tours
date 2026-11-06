<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomImage extends Model
{
    protected $fillable = ['hotel_room_id', 'image', 'sort_order'];

    public function room()
    {
        return $this->belongsTo(HotelRoom::class, 'hotel_room_id');
    }
}