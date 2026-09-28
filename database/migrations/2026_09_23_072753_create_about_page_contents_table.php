<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_page_contents', function (Blueprint $table) {
            $table->id();

            // ---- Banner ----
            $table->string('banner_heading')->nullable();
            $table->text('banner_description')->nullable();
            $table->string('banner_cta_text')->nullable();
            $table->string('banner_cta_url')->nullable();
            $table->string('banner_video')->nullable();
            $table->string('banner_video_poster')->nullable();

            // ---- Who We Are (stats + content card) ----
            $table->string('who_we_are_heading')->nullable();
            $table->text('who_we_are_description')->nullable();
            // stats: [{icon, count, suffix, label}, ...]  (4 stat cards)
            $table->json('stats')->nullable();
            $table->string('content_card_title')->nullable();
            $table->text('content_card_description_1')->nullable();
            $table->text('content_card_description_2')->nullable();
            $table->string('content_card_cta_text')->nullable();
            $table->string('content_card_cta_url')->nullable();
            $table->string('content_card_image')->nullable();

            // ---- Why Choose Us ----
            $table->string('why_choose_heading')->nullable();
            $table->text('why_choose_description')->nullable();
            // why_choose_items: [{icon, title, description}, ...]
            $table->json('why_choose_items')->nullable();

            // ---- Our Mission ----
            $table->string('mission_heading')->nullable();
            $table->text('mission_description')->nullable();
            $table->string('mission_image_one')->nullable();
            $table->string('mission_image_two')->nullable();
            // mission_features: [{icon, title, description}, ...]
            $table->json('mission_features')->nullable();
            $table->string('mission_cta_text')->nullable();
            $table->string('mission_cta_url')->nullable();

            // ---- How It Works ----
            $table->string('how_it_works_heading')->nullable();
            $table->text('how_it_works_description')->nullable();
            // how_it_works_steps: [{color, title, description}, ...] (number is derived from position)
            $table->json('how_it_works_steps')->nullable();

            // ---- Our Philosophy ----
            $table->string('philosophy_eyebrow')->nullable();
            $table->string('philosophy_heading')->nullable();
            $table->string('philosophy_heading_highlight')->nullable();
            $table->text('philosophy_description')->nullable();
            $table->string('philosophy_cta_text')->nullable();
            $table->string('philosophy_cta_url')->nullable();
            $table->string('philosophy_image')->nullable();

            // ---- Meet The Team ----
            $table->string('team_heading')->nullable();
            $table->text('team_description')->nullable();
            // team_members: [{image, name, role, instagram_url, linkedin_url}, ...]
            $table->json('team_members')->nullable();

            // ---- Clients Feedback / Testimonials (heading only — cards come from Testimonial model) ----
            $table->string('testimonials_heading')->nullable();
            $table->text('testimonials_description')->nullable();

            // ---- Moments From The Journey (gallery) ----
            $table->string('gallery_heading')->nullable();
            $table->text('gallery_description')->nullable();
            // gallery_items: [{image, title, location}, ...]
            $table->json('gallery_items')->nullable();

            // ---- Get to Know Our Journey (FAQ accordion) ----
            $table->string('faq_heading')->nullable();
            // faqs: [{question, answer}, ...]
            $table->json('faqs')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_page_contents');
    }
};