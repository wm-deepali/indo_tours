<?php
// app/Models/TourPackageExclude.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TourPackageExclude extends Model
{
    protected $fillable = ['tour_package_id', 'text', 'sort_order'];
}