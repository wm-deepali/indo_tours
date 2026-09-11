<?php
// app/Models/TourPackageDurationOption.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TourPackageDurationOption extends Model
{
    protected $fillable = ['tour_package_id', 'image', 'days_label', 'price', 'sort_order'];
}