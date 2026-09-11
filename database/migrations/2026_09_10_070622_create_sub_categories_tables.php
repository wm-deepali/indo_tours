<?php
// database/migrations/2026_09_10_000000_create_sub_categories_tables.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('status')->default('draft');

            // Banner
            $table->string('offer_tag_text')->nullable();
            $table->string('h1')->nullable();
            $table->text('intro_text')->nullable();
            $table->string('banner_image_one')->nullable();
            $table->string('banner_image_two')->nullable();
            $table->string('button1_text')->nullable();
            $table->string('button1_url')->nullable();
            $table->string('button2_text')->nullable();
            $table->string('button2_url')->nullable();

            // Highlights section heading
            $table->string('heading_text')->nullable();
            $table->string('heading_highlight')->nullable();
            $table->text('heading_intro')->nullable();

            // CTA
            $table->string('cta_badge_text')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_image')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();
            $table->string('cta_button2_text')->nullable();
            $table->string('cta_button2_url')->nullable();

            // Promo
            $table->string('promo_badge_text')->nullable();
            $table->string('promo_title')->nullable();
            $table->text('promo_description')->nullable();
            $table->string('promo_button_text')->nullable();
            $table->string('promo_button_url')->nullable();
            $table->dateTime('promo_end_at')->nullable();

            // FAQ heading
            $table->string('faq_heading')->nullable();
            $table->string('faq_heading_highlight')->nullable();
            $table->text('faq_intro')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('canonical_url')->nullable();

            $table->timestamps();
        });

        Schema::create('sub_category_highlights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id')->constrained()->cascadeOnDelete();
            $table->string('icon_image')->nullable();
            $table->string('title')->nullable();
            $table->string('value')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('sub_category_cta_perks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id')->constrained()->cascadeOnDelete();
            $table->string('text');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('sub_category_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id')->constrained()->cascadeOnDelete();
            $table->string('question');
            $table->text('answer')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_category_faqs');
        Schema::dropIfExists('sub_category_cta_perks');
        Schema::dropIfExists('sub_category_highlights');
        Schema::dropIfExists('sub_categories');
    }
};