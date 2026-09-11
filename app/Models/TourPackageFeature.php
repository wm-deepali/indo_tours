<?php
// app/Models/TourPackageFeature.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TourPackageFeature extends Model
{
    protected $fillable = ['tour_package_id', 'icon_image', 'text', 'sort_order'];
}