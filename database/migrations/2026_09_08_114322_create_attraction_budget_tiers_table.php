<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attraction_budget_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attraction_id')->constrained()->cascadeOnDelete();
            $table->string('tier_name');            // Budget / Mid-range / Premium
            $table->string('price_range');          // "₹2,000 – ₹4,000"
            $table->string('price_unit')->default('/ day');
            $table->string('note')->nullable();
            $table->json('features')->nullable();   // ["Guesthouses and homestays", ...]
            $table->boolean('is_recommended')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attraction_budget_tiers');
    }
};