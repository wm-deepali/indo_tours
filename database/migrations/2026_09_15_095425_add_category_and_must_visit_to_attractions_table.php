<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attractions', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->after('id')
                ->constrained('attraction_categories')
                ->nullOnDelete();

            $table->boolean('is_must_visit')->default(false)->after('is_featured');
        });
    }

    public function down(): void
    {
        Schema::table('attractions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropColumn('is_must_visit');
        });
    }
};