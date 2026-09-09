<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attraction_itineraries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attraction_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('days');
            $table->string('title');
            $table->boolean('is_popular')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('attraction_itinerary_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attraction_itinerary_id')->constrained()->onDelete('cascade');
            $table->string('stop_name');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attraction_itinerary_stops');
        Schema::dropIfExists('attraction_itineraries');
    }
};