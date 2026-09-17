<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_destination', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blogs')->cascadeOnDelete();
            $table->foreignId('destination_id')->constrained('destinations')->cascadeOnDelete();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('blog_attraction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blogs')->cascadeOnDelete();
            $table->foreignId('attraction_id')->constrained('attractions')->cascadeOnDelete();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('blog_activity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blogs')->cascadeOnDelete();
            $table->foreignId('activity_id')->constrained('activities')->cascadeOnDelete();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('blog_tour_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blogs')->cascadeOnDelete();
            $table->foreignId('tour_package_id')->constrained('tour_packages')->cascadeOnDelete();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_tour_package');
        Schema::dropIfExists('blog_activity');
        Schema::dropIfExists('blog_attraction');
        Schema::dropIfExists('blog_destination');
    }
};