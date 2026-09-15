<?php
// database/migrations/xxxx_xx_xx_create_landing_page_activities_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('landing_page_activities', function (Blueprint $table) {
            $table->id();

            // ---- Hero Banner ----
            $table->json('hero_slider_images')->nullable(); // [{image, alt}, ...]
            $table->string('hero_badge_text')->nullable();
            $table->string('hero_heading')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_cta_text')->nullable();
            $table->string('hero_cta_url')->nullable();

            // ---- Intro ----
            $table->string('intro_heading')->nullable();
            $table->text('intro_description')->nullable();

            // ---- Offer Promo ----
            $table->string('offer_badge_text')->nullable();
            $table->string('offer_heading')->nullable();
            $table->text('offer_description')->nullable();
            $table->string('offer_cta_text')->nullable();
            $table->string('offer_cta_url')->nullable();
            $table->dateTime('offer_countdown_end')->nullable(); // leave blank to hide countdown

            // ---- Group Offer Banner ----
            $table->string('group_offer_badge_text')->nullable();
            $table->string('group_offer_heading')->nullable();
            $table->text('group_offer_description')->nullable();
            $table->json('group_offer_perks')->nullable(); // ["perk 1", "perk 2", ...]
            $table->string('group_offer_cta1_text')->nullable();
            $table->string('group_offer_cta1_url')->nullable();
            $table->string('group_offer_cta2_text')->nullable();
            $table->string('group_offer_cta2_url')->nullable();
            $table->string('group_offer_image')->nullable();

            // ---- Planning Guide ----
            $table->string('planning_eyebrow')->nullable();
            $table->string('planning_heading')->nullable();
            $table->json('planning_blocks')->nullable(); // [{title, content}, ...]

            // ---- Why Book With Us ----
            $table->string('benefits_heading')->nullable();
            $table->text('benefits_description')->nullable();
            $table->json('benefits_items')->nullable(); // [{icon_svg, title, description}, ...]

            // ---- Final CTA ----
            $table->string('final_cta_heading')->nullable();
            $table->text('final_cta_description')->nullable();
            $table->string('final_cta1_text')->nullable();
            $table->string('final_cta1_url')->nullable();
            $table->string('final_cta2_text')->nullable();
            $table->string('final_cta2_url')->nullable();

            $table->json('related_destinations_heading')->nullable();
            $table->text('related_destinations_description')->nullable();
            $table->json('related_destination_ids')->nullable(); 

            $table->string('seo_links_heading')->nullable();
            $table->text('seo_links_description')->nullable();
            $table->json('seo_link_blocks')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_page_activities');
    }
};