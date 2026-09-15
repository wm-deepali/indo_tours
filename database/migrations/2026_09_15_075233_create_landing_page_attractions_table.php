<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_page_attractions', function (Blueprint $table) {
            $table->id();

            // Hero
            $table->string('hero_heading')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_video')->nullable();

            // Destinations grid (heading only — cards pulled from Destination model)
            $table->string('destinations_heading')->nullable();
            $table->text('destinations_description')->nullable();

            // Featured Attractions swiper (heading only — cards pulled from Attraction::is_featured)
            $table->string('featured_heading')->nullable();
            $table->text('featured_description')->nullable();

            // Must-Visit (heading only — cards pulled from Attraction ordered by rating)
            $table->string('must_visit_heading')->nullable();
            $table->text('must_visit_description')->nullable();

            // Promo / Offer banner
            $table->string('promo_eyebrow')->nullable();
            $table->string('promo_heading')->nullable();
            $table->text('promo_description')->nullable();
            $table->string('promo_image')->nullable();
            $table->string('promo_primary_text')->nullable();
            $table->string('promo_primary_url')->nullable();
            $table->string('promo_secondary_text')->nullable();
            $table->string('promo_secondary_url')->nullable();

            // Travel Guides repeater
            $table->string('guides_heading')->nullable();
            $table->text('guides_description')->nullable();
            $table->json('guide_items')->nullable();

            // FAQs repeater (page-level, separate from Attraction::faqs())
            $table->string('faqs_heading')->nullable();
            $table->json('faqs')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_page_attractions');
    }
};