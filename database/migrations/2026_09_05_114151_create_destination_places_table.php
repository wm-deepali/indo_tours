<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destination_places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->string('name'); // e.g. "Srinagar"
            $table->string('description')->nullable(); // e.g. "Dal Lake, Mughal Gardens and local markets."
            $table->boolean('is_featured')->default(false); // controls the large card
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destination_places');
    }
};