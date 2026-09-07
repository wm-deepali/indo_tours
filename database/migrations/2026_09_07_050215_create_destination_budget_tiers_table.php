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
        // destination_budget_tiers
        Schema::create('destination_budget_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('name');           // "Budget", "Comfort", "Premium"
            $table->string('price_from');     // stored as text so admin can format freely: "25,000"
            $table->string('price_to')->nullable();
            $table->string('price_suffix')->nullable(); // "+" for "60,000+"
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('badge_text')->nullable(); // "Popular"
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        // destination_budget_breakdown
        Schema::create('destination_budget_breakdowns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('label');   // "Stay", "Transport"...
            $table->unsignedTinyInteger('percent');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_budget_tiers');
        Schema::dropIfExists('destination_budget_breakdowns');
    }
};
