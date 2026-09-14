<?php
// database/migrations/2026_09_10_000004_create_tour_packages_tables.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('status')->default('draft');

            // Location (mirrors Destination/Hotel pattern)
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('state_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained()->nullOnDelete();

            // Banner
            $table->string('banner_tag_text')->nullable();
            $table->text('banner_intro')->nullable();
            $table->string('main_image')->nullable();
            $table->string('top_image')->nullable();
            $table->string('bottom_left_image')->nullable();
            $table->string('bottom_right_image')->nullable();
            $table->string('video_url')->nullable();

            // Trip info
            $table->string('duration_text')->nullable();
            $table->decimal('old_price', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('price_unit_text')->nullable();

            // Overview
            $table->string('overview_title')->nullable();
            $table->text('overview_content')->nullable();

            // Map
            $table->text('map_embed_url')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('canonical_url')->nullable();

            $table->timestamps();
        });

        Schema::create('tour_package_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
            $table->string('icon_image')->nullable();
            $table->string('text');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tour_package_duration_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->string('days_label');
            $table->decimal('price', 10, 2)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tour_package_route_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tour_package_highlights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
            $table->string('text');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tour_package_itinerary_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('day_number')->default(1);
            $table->string('title');
            $table->text('content')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tour_package_hotel_stays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
            $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();
            $table->string('day_label')->nullable();
            $table->string('title')->nullable();
            $table->string('check_in')->nullable();
            $table->string('check_out')->nullable();
            $table->boolean('breakfast_included')->default(false);
            $table->boolean('lunch_included')->default(false);
            $table->boolean('dinner_included')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tour_package_includes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
            $table->string('text');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tour_package_excludes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
            $table->string('text');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tour_package_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('content')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tour_package_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
            $table->string('question');
            $table->text('answer')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_package_faqs');
        Schema::dropIfExists('tour_package_policies');
        Schema::dropIfExists('tour_package_excludes');
        Schema::dropIfExists('tour_package_includes');
        Schema::dropIfExists('tour_package_hotel_stays');
        Schema::dropIfExists('tour_package_itinerary_days');
        Schema::dropIfExists('tour_package_highlights');
        Schema::dropIfExists('tour_package_route_stops');
        Schema::dropIfExists('tour_package_duration_options');
        Schema::dropIfExists('tour_package_features');
        Schema::dropIfExists('tour_packages');
    }
};