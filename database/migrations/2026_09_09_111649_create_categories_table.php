<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_categories_table.php
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            // General
            $table->string('name');                 // Category Name
            $table->string('menu_name')->nullable(); // Menu Name
            $table->string('slug')->unique();
            $table->string('sub_title')->nullable();
            $table->string('heading')->nullable();   // Heading for Listing Page

            $table->string('listing_eyebrow')->nullable();
            $table->string('listing_heading')->nullable();
            $table->string('listing_heading_highlight')->nullable();
            $table->text('listing_intro')->nullable();
            $table->string('listing_button_text')->nullable();
            $table->string('listing_button_url')->nullable();
            $table->string('listing_button2_text')->nullable();
            $table->string('listing_button2_url')->nullable();

            $table->string('promo_badge_text')->nullable();
            $table->string('promo_title')->nullable();
            $table->text('promo_description')->nullable();
            $table->string('promo_button_text')->nullable();
            $table->string('promo_button_url')->nullable();
            $table->dateTime('promo_end_at')->nullable();

            $table->string('plan_heading')->nullable();
            $table->string('plan_heading_highlight')->nullable();
            $table->text('plan_intro')->nullable();

            $table->text('short_description')->nullable();
            $table->longText('detail_content')->nullable(); // rich text
            $table->string('image')->nullable();
            $table->enum('status', ['draft', 'published', 'unpublished'])->default('draft');

            // CTA Section
            $table->string('cta_title')->nullable();
            $table->string('cta_badge_text')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();
            $table->string('cta_button2_text')->nullable();
            $table->string('cta_button2_url')->nullable();
            $table->string('cta_image')->nullable();

            // SEO
            $table->string('h1')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('canonical_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
