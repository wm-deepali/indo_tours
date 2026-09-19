<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('show_in_header')->default(false)->after('status');
            $table->unsignedInteger('header_sort_order')->default(0)->after('show_in_header');
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->boolean('show_in_header')->default(false)->after('status');
            $table->unsignedInteger('header_sort_order')->default(0)->after('show_in_header');
        });

        Schema::table('activity_categories', function (Blueprint $table) {
            $table->boolean('show_in_header')->default(false)->after('status');
            $table->unsignedInteger('header_sort_order')->default(0)->after('show_in_header');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['show_in_header', 'header_sort_order']);
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropColumn(['show_in_header', 'header_sort_order']);
        });

        Schema::table('activity_categories', function (Blueprint $table) {
            $table->dropColumn(['show_in_header', 'header_sort_order']);
        });
    }
};