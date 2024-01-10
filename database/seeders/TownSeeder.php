<?php

namespace Database\Seeders;

use App\Models\Town;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $towns = [
            ['name' =>'Westlands', 'county_id' => 1, 'shortcode' => 'WST'],
            ['name' =>'Ruiru', 'county_id' => 2, 'shortcode' => 'RUI']
        ];

        $townData = null;

        foreach ($towns as $town) {
            try {
                $townData = [
                    'identifier' => generate_identifier(),
                    'county_id' => $town['county_id'],
                    'name' => $town['name'],
                    'shortcode' => $town['shortCode'],
                    'active' => $town['name'] == 'Africa',
                    'added_by' => 1,
                    'activated_by' => 1,
                    'activated_at' => Carbon::now(),
                    'updated_by' => 1,
                ];
                Town::create($townData);
            } catch (\Throwable $error) {
                Log::error(response()->json([
                        'status' => "FAIL",
                        'message' => 'Creating Continent - '.$town['name'].' failed at TownSeeder',
                        'data' => $townData,
                        'error' => $error
                    ])
                );
            }
        }
    }
}
