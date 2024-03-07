<?php

namespace Database\Seeders;

use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ["name" => "United State of America", 'continent_id' => 6, 'shortcode' => 'USA'],
            ["name" => "Kenya", 'continent_id' => 1, 'shortcode' => 'KE'],
            ["name" => "Dubai", 'continent_id' => 3, 'shortcode' => 'DBX'],
        ];

        $countryData = null;

        foreach ($countries as $country) {
            try {
                $countryData = [
                    'identifier' => generate_identifier(),
                    'name' => $country['name'],
                    'continent_id' => $country['continent_id'],
                    'shortcode' => $country['shortcode'],
                    'active' => $country['name'] == 'Africa',
                    'added_by' => 1,
                    'activated_by' => 1,
                    'activated_at' => Carbon::now(),
                    'updated_by' => 1,
                ];
                Country::create($countryData);
            } catch (\Throwable $error) {
                Log::error(
                    response()->json([
                        'status' => "FAIL",
                        'message' => 'Creating Country - ' . $country['name'] . ' failed at CountrySeeder',
                        'data' => $countryData,
                        'error' => $error
                    ])
                );
            }
        }
    }
}
