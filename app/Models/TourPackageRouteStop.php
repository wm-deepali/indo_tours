<?php
// app/Models/TourPackageRouteStop.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TourPackageRouteStop extends Model
{
    protected $fillable = ['tour_package_id', 'name', 'sort_order'];
}