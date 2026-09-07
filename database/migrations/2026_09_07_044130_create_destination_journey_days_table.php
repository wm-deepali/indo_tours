<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // destination_journey_days
        Schema::create('destination_journey_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('day_number');
            $table->string('title');           // place name, or "Departure"
            $table->string('image')->nullable();
            $table->text('flow_text')->nullable();
            $table->string('stay_text')->nullable();
            $table->string('food_text')->nullable();
            $table->boolean('is_departure')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('destination_seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('range_text');   // "March – April"
            $table->string('name');         // "Spring"
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_journey_days');
        Schema::dropIfExists('destination_seasons');
    }
};
