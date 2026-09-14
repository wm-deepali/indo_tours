<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();

            // General
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('state_id')->nullable()->constrained('states')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->string('location_label')->nullable(); // e.g. "Downtown Dubai, UAE"

            $table->string('banner_tag')->nullable(); // e.g. "Explore Dubai"
            $table->text('banner_description')->nullable(); // subtitle under H1

            $table->string('main_image')->nullable();
            $table->string('video_url')->nullable();

            $table->string('banner_top_image')->nullable();
            $table->string('banner_top_label')->nullable();
            $table->string('banner_top_title')->nullable();

            $table->string('banner_left_image')->nullable();
            $table->string('banner_left_label')->nullable();
            $table->string('banner_left_title')->nullable();

            $table->string('banner_right_image')->nullable();
            $table->string('banner_right_label')->nullable();
            $table->string('banner_right_title')->nullable();

            $table->string('duration_text')->nullable(); // e.g. "2-3 hrs"
            $table->string('free_cancellation_text')->nullable(); // blank = hide badge

            $table->decimal('rating', 2, 1)->nullable();
            $table->unsignedInteger('review_count')->default(0);

            $table->decimal('starting_price', 10, 2)->nullable();
            $table->string('price_unit')->nullable()->default('/ Adult');

            // About
            $table->string('about_title')->nullable(); // defaults to "About {name}"
            $table->longText('about_content')->nullable();
            $table->json('highlights')->nullable(); // flat bullet list
            $table->longText('what_to_expect_content')->nullable();
            $table->json('know_before_you_go')->nullable(); // flat bullet list
            $table->json('sidebar_points')->nullable(); // flat bullet list

            $table->text('map_embed_url')->nullable();
            $table->text('map_address')->nullable();
            $table->json('map_points')->nullable();
            $table->string('map_directions_url')->nullable();

            $table->enum('status', ['draft', 'published', 'unpublished'])->default('draft');
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};