<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_tour_package_enquiries_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_package_enquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('travel_date')->nullable();
            $table->unsignedInteger('traveller_count')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('new'); // new | contacted | closed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_package_enquiries');
    }
};