<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_page_contents', function (Blueprint $table) {
            $table->id();

            // ---- Hero Banner ----
            $table->string('hero_eyebrow')->nullable();
            $table->string('hero_heading')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_person_image')->nullable();
            $table->string('hero_illustration_image')->nullable();

            // ---- Promo Grid ----
            $table->string('promo_eyebrow')->nullable();
            $table->string('promo_heading')->nullable();
            $table->string('promo_cta_text')->nullable();
            $table->string('promo_cta_url')->nullable();
            $table->string('promo_image')->nullable();
            $table->string('promo_script_line_1')->nullable();
            $table->string('promo_script_line_2')->nullable();

            // ---- Group Offer Banner ----
            $table->string('group_offer_badge_text')->nullable();
            $table->string('group_offer_heading')->nullable();
            $table->text('group_offer_description')->nullable();
            $table->json('group_offer_perks')->nullable();
            $table->string('group_offer_cta1_text')->nullable();
            $table->string('group_offer_cta1_url')->nullable();
            $table->string('group_offer_cta2_text')->nullable();
            $table->string('group_offer_cta2_url')->nullable();
            $table->string('group_offer_image')->nullable();

            // ---- Who We Are ----
            $table->string('who_we_are_badge')->nullable();
            $table->string('who_we_are_heading')->nullable();
            $table->string('who_we_are_heading_highlight')->nullable();
            $table->text('who_we_are_description')->nullable();
            $table->string('who_we_are_image')->nullable();
            $table->json('who_we_are_stats')->nullable();
            $table->string('who_we_are_cta_text')->nullable();
            $table->string('who_we_are_cta_url')->nullable();

            // ---- Home Slider ----
            $table->json('home_slider_images')->nullable();

            // ---- Testimonials (heading only) ----
            $table->string('testimonials_heading')->nullable();
            $table->text('testimonials_description')->nullable();

            // ---- Discount Strip ----
            $table->string('discount_strip_eyebrow')->nullable();
            $table->string('discount_strip_percent')->nullable();
            $table->string('discount_strip_label')->nullable();
            $table->string('discount_strip_cta_text')->nullable();
            $table->string('discount_strip_cta_url')->nullable();
            $table->string('discount_strip_bg_image')->nullable();
            $table->string('discount_strip_side_image')->nullable();

            // ---- "We're There" Support Section ----
            $table->string('support_heading')->nullable();
            $table->string('support_heading_highlight')->nullable();
            $table->text('support_description')->nullable();
            $table->string('support_image')->nullable();
            $table->json('support_items')->nullable();

            // ---- Newsletter / App Promo ----
            $table->string('newsletter_eyebrow')->nullable();
            $table->string('newsletter_heading')->nullable();
            $table->string('newsletter_cta_text')->nullable();
            $table->string('newsletter_phone_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_page_contents');
    }
};