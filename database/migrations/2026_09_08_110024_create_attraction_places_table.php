<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attraction_places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attraction_id')->constrained()->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('tag')->nullable();       // e.g. "Kashmir"
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('button_text')->nullable(); // e.g. "Explore Srinagar"
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attraction_places');
    }
};