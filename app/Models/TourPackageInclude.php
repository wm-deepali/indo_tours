<?php
// app/Models/TourPackageInclude.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TourPackageInclude extends Model
{
    protected $fillable = ['tour_package_id', 'text', 'sort_order'];
}