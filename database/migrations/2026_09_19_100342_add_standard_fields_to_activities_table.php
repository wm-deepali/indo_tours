<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->decimal('duration_from', 6, 2)->nullable()->after('duration_text');
            $table->decimal('duration_to', 6, 2)->nullable()->after('duration_from');
            $table->string('duration_unit', 10)->default('hours')->after('duration_to');
            $table->decimal('duration_hours', 8, 2)->nullable()->after('duration_unit')->index();
            $table->unsignedSmallInteger('free_cancellation_hours')->nullable()->after('free_cancellation_text');
        });

        // Backfill from the old free-text values
        DB::table('activities')->orderBy('id')->chunkById(100, function ($rows) {
            foreach ($rows as $row) {
                $update = [];

                // "2-3 hrs", "45 mins", "1 Day"
                if (
                    $row->duration_text
                    && preg_match('/(\d+(?:\.\d+)?)\s*(?:[-–]\s*(\d+(?:\.\d+)?))?\s*(min|hr|hour|day)/i', $row->duration_text, $m)
                ) {
                    $from = (float) $m[1];
                    $to   = !empty($m[2]) ? (float) $m[2] : null;
                    $word = strtolower($m[3]);
                    $unit = $word === 'min' ? 'minutes' : ($word === 'day' ? 'days' : 'hours');
                    $top  = max($from, (float) $to);

                    $update['duration_from']  = $from;
                    $update['duration_to']    = ($to && $to > $from) ? $to : null;
                    $update['duration_unit']  = $unit;
                    $update['duration_hours'] = $unit === 'minutes' ? round($top / 60, 2) : ($unit === 'days' ? $top * 24 : $top);
                }

                // Had a "Free Cancellation" badge -> assume the standard 24 hour window
                if (!empty($row->free_cancellation_text)) {
                    $update['free_cancellation_hours'] = 24;
                }

                // "/ Adult" -> "Per Adult" (same standard values as tour packages)
                $unitText = trim((string) $row->price_unit);
                if ($unitText !== '' && str_starts_with($unitText, '/')) {
                    $update['price_unit'] = 'Per ' . trim(substr($unitText, 1));
                }

                if ($update) {
                    DB::table('activities')->where('id', $row->id)->update($update);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn([
                'duration_from',
                'duration_to',
                'duration_unit',
                'duration_hours',
                'free_cancellation_hours',
            ]);
        });
    }
};