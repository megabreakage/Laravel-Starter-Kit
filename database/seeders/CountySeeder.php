<?php

namespace Database\Seeders;

use App\Models\County;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $counties = [
            ['name' => 'Nairobi', 'country_id' => 1, 'shortcode' => 'NRB'],
            ['name' => 'Kiambu', 'country_id' => 2, 'shortcode' => 'KMB'],
            ['name' => 'Mombasa', 'country_id' => 3, 'shortcode' => 'MBA'],
        ];

        $countyData = null;

        foreach ($counties as $county) {
            try {
                $countyData = [
                    'identifier' => generate_identifier(),
                    'country_id' => $county['country_id'],
                    'name' => $county['name'],
                    'shortcode' => $county['shortCode'],
                    'active' => $county['name'] == 'Africa',
                    'added_by' => 1,
                    'activated_by' => 1,
                    'activated_at' => Carbon::now(),
                    'updated_by' => 1,
                ];
                County::create($countyData);
            } catch (\Throwable $error) {
                Log::error(response()->json([
                        'status' => "FAIL",
                        'message' => 'Creating Continent - '.$county['name'].' failed at CountySeeder',
                        'data' => $countyData,
                        'error' => $error
                    ])
                );
            }
        }
    }
}
