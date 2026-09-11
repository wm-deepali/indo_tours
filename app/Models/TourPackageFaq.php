<?php
// app/Models/TourPackageFaq.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TourPackageFaq extends Model
{
    protected $fillable = ['tour_package_id', 'question', 'answer', 'sort_order'];
}