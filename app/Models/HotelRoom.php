<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    protected $fillable = [
        'hotel_id', 'name', 'room_type', 'description',
        'max_adults', 'max_children', 'bed_type', 'room_size',
        'amenities', 'old_price', 'price', 'price_unit', 'tax_note',
        'is_active', 'sort_order',
    ];

    protected $casts = [
        'amenities' => 'array',
        'old_price' => 'decimal:2',
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function images()
    {
        return $this->hasMany(HotelRoomImage::class)->orderBy('sort_order');
    }

    public function getDiscountPercentAttribute(): ?int
    {
        if ($this->old_price && $this->price && $this->old_price > $this->price) {
            return (int) round((($this->old_price - $this->price) / $this->old_price) * 100);
        }
        return null;
    }
}