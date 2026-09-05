<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportLocations extends Command
{
    /**
     * php artisan import:locations
     *
     * Reads storage/app/countries-states-cities/countries+states+cities.json
     * (nested: country -> states[] -> cities[]) and seeds the
     * countries / states / cities tables, preserving the hierarchy.
     */
    protected $signature = 'import:locations {--fresh : Truncate countries, states and cities first}';

    protected $description = 'Import countries, states and cities from the dr5hn nested JSON dataset';

    private const FILE_PATH = 'countries-states-cities/countries+states+cities.json';

    public function handle(): int
    {
        $path = storage_path('app/' . self::FILE_PATH);

        if (!file_exists($path)) {
            $this->error("File not found: {$path}");
            $this->line('Download it from: https://github.com/dr5hn/countries-states-cities-database/blob/master/json/countries%2Bstates%2Bcities.json');
            $this->line('and place it at: storage/app/' . self::FILE_PATH);

            return self::FAILURE;
        }

        $this->info('Reading countries+states+cities.json ...');
        $countries = json_decode(file_get_contents($path), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Failed to parse JSON: ' . json_last_error_msg());

            return self::FAILURE;
        }

        if ($this->option('fresh')) {
            $this->warn('Truncating cities, states, countries ...');
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('cities')->truncate();
            DB::table('states')->truncate();
            DB::table('countries')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        $this->info('Importing ' . count($countries) . ' countries with their states and cities ...');
        $bar = $this->output->createProgressBar(count($countries));

        $countrySort = 1;

        foreach ($countries as $country) {
            $countryId = DB::table('countries')->insertGetId([
                'name'       => $country['name'],
                'slug'       => Str::slug($country['name']) . '-' . $country['id'],
                'sort_order' => $countrySort++,
                'status'     => 1,
            ]);

            $states = $country['states'] ?? [];
            $stateSort = 1;

            foreach ($states as $state) {
                $stateId = DB::table('states')->insertGetId([
                    'country_id' => $countryId,
                    'name'       => $state['name'],
                    'slug'       => Str::slug($state['name']) . '-' . $state['id'],
                    'sort_order' => $stateSort++,
                    'status'     => 1,
                ]);

                $cities = $state['cities'] ?? [];

                if (!empty($cities)) {
                    $citySort = 1;
                    foreach (array_chunk($cities, 500) as $chunk) {
                        $rows = [];
                        foreach ($chunk as $city) {
                            $rows[] = [
                                'state_id'   => $stateId,
                                'name'       => $city['name'],
                                'slug'       => Str::slug($city['name']) . '-' . $city['id'],
                                'sort_order' => $citySort++,
                                'status'     => 1,
                            ];
                        }
                        DB::table('cities')->insert($rows);
                    }
                }
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Done. Countries: ' . DB::table('countries')->count()
            . ', States: ' . DB::table('states')->count()
            . ', Cities: ' . DB::table('cities')->count());

        return self::SUCCESS;
    }
}