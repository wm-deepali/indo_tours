<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_tour_package_reviews_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_package_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('designation')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedTinyInteger('rating'); // 1-5
            $table->text('review');
            $table->string('status')->default('approved'); // approved | pending | rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_package_reviews');
    }
};