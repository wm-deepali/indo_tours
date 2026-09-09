<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attraction_seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attraction_id')->constrained()->cascadeOnDelete();
            $table->string('months');          // e.g. "Mar – May"
            $table->string('title');           // e.g. "Spring"
            $table->text('description')->nullable();
            $table->json('tags')->nullable();  // ["Gardens", "Fewer crowds"]
            $table->boolean('is_active')->default(false); // highlighted as current season
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attraction_seasons');
    }
};