<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->string('why_visit_image')->nullable()->after('recommended_for');
            $table->string('why_visit_media_tag')->nullable()->after('why_visit_image');
        });

        Schema::create('destination_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->string('name'); // e.g. "Srinagar"
            $table->string('tag')->nullable(); // e.g. "Best for first-time visitors"
            $table->string('stay_duration')->nullable(); // e.g. "2–3 Nights"
            $table->text('why_text')->nullable();
            $table->string('nearby_text')->nullable(); // e.g. "Dal Lake · Nishat Bagh · Shalimar Bagh"
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('destination_highlights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('icon')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destination_highlights');
        Schema::dropIfExists('destination_areas');
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['why_visit_image', 'why_visit_media_tag']);
        });
    }
};