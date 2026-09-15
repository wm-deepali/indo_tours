<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('landing_page_destinations', function (Blueprint $table) {
            $table->id();

            // ---- Hero Banner ----
            $table->string('hero_heading')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_video')->nullable();

            // ---- Destinations Grid ----
            $table->string('destinations_heading')->nullable();
            $table->text('destinations_description')->nullable();

            // ---- Featured Tour Packages ----
            $table->string('packages_heading')->nullable();
            $table->text('packages_description')->nullable();

            // ---- Why Travel Simple ----
            $table->string('why_travel_heading')->nullable();
            $table->text('why_travel_description')->nullable();
            $table->json('why_travel_items')->nullable(); // [{icon, title, description}]

            // ---- Highlight Section ----
            $table->string('highlight_image')->nullable();
            $table->string('highlight_tag')->nullable();
            $table->string('highlight_heading')->nullable();
            $table->text('highlight_description')->nullable();
            $table->json('highlight_points')->nullable(); // ["point 1", "point 2", ...]
            $table->string('highlight_cta_text')->nullable();
            $table->string('highlight_cta_url')->nullable();

            // ---- Experiences You'll Love ----
            $table->string('experiences_heading')->nullable();
            $table->text('experiences_description')->nullable();
            $table->json('experience_items')->nullable(); // [{image, title, description, link_url}]

            // ---- Travel Guides ----
            $table->string('guides_heading')->nullable();
            $table->text('guides_description')->nullable();
            $table->json('guide_items')->nullable(); // [{image, category, title, description, link_url}]

            // ---- FAQs ----
            $table->string('faqs_heading')->nullable();
            $table->json('faqs')->nullable(); // [{question, answer}]

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_page_destinations');
    }
};