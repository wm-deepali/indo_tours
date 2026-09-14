<?php
// database/migrations/2026_09_11_000002_create_activity_packages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained('activities')->cascadeOnDelete();

            $table->string('title');
            $table->string('duration_label')->nullable(); // e.g. "Prime Hours"
            $table->text('description')->nullable();
            $table->json('includes')->nullable(); // flat bullet list

            $table->decimal('old_price', 10, 2)->nullable();
            $table->decimal('new_price', 10, 2)->nullable();
            $table->string('save_text')->nullable(); // e.g. "Save 10%"

            $table->boolean('is_recommended')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_packages');
    }
};