<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->string('verdict_title')->nullable()->after('description');
            $table->string('recommended_for')->nullable()->after('verdict_title');
        });

        Schema::create('destination_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('icon')->nullable(); // stored path under destinations/matches
            $table->string('want'); // e.g. "Mountains"
            $table->string('offer_text'); // e.g. "Himalayan valleys and panoramic viewpoints..."
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destination_matches');
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['verdict_title', 'recommended_for']);
        });
    }
};