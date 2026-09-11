<?php
// app/Models/TourPackageHighlight.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TourPackageHighlight extends Model
{
    protected $fillable = ['tour_package_id', 'text', 'sort_order'];
}