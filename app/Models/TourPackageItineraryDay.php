<?php
// app/Models/TourPackageItineraryDay.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TourPackageItineraryDay extends Model
{
    protected $fillable = ['tour_package_id', 'day_number', 'title', 'content', 'sort_order'];
}