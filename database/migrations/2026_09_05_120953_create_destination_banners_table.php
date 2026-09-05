<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destination_banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('badge_text')->nullable();
            $table->string('heading')->nullable();
            $table->text('description')->nullable();
            $table->json('perks')->nullable();
            $table->string('image')->nullable();
            $table->string('cta_primary_text')->nullable();
            $table->string('cta_primary_link')->nullable();
            $table->string('cta_secondary_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_banners');
    }
};
