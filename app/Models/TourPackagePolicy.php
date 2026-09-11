<?php
// app/Models/TourPackagePolicy.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TourPackagePolicy extends Model
{
    protected $fillable = ['tour_package_id', 'title', 'content', 'sort_order'];
}