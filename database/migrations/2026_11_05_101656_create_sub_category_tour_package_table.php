<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_category_tour_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained('tour_packages')->cascadeOnDelete();
            $table->foreignId('sub_category_id')->constrained('sub_categories')->cascadeOnDelete();
            $table->unique(['tour_package_id', 'sub_category_id']);
        });

        // Backfill existing packages from the old single column
        DB::statement('
            INSERT INTO sub_category_tour_package (tour_package_id, sub_category_id)
            SELECT id, sub_category_id FROM tour_packages WHERE sub_category_id IS NOT NULL
        ');
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_category_tour_package');
    }
};