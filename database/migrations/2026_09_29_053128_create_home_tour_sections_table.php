<?php
// database/migrations/2026_09_29_000001_create_home_tour_sections_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_tour_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');                              // "Tours In"
            $table->string('highlight')->nullable();              // "Maldives"
            $table->text('description')->nullable();
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->nullOnDelete();
            $table->unsignedTinyInteger('limit')->default(8);
            $table->string('view_all_url')->nullable();
            $table->string('placement')->default('after_banner'); // after_banner | after_promo | after_slider | after_support
            $table->string('style_class')->default('home-secA');  // home-secA | home-secC | home-secG | home-secG home-secJ
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_tour_sections');
    }
};