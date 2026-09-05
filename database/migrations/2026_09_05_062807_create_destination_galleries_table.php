<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destination_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destinations')->cascadeOnDelete();
            $table->string('image');
            $table->string('title')->nullable();     // "Dal Lake" (overlay heading)
            $table->string('subtitle')->nullable();  // "Srinagar, Kashmir" (overlay subtext)
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destination_galleries');
    }
};