<?php

namespace Database\Seeders;

use App\Models\Continent;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ContinentSeeder extends Seeder
{

    public function run(): void
    {

        $continents = processStrings([
            "Africa", 
            "Antarctica", 
            "Asia", 
            "Australia", 
            "Europe", 
            "North America", 
            "South America"
        ]);

        $continentData = null;

        foreach ($continents as $continent) {
            try {
                $continentData = [
                    'identifier' => generate_identifier(),
                    'name' => $continent['name'],
                    'shortcode' => $continent['shortCode'],
                    'active' => $continent['name'] == 'Africa',
                    'added_by' => 1,
                    'activated_by' => 1,
                    'activated_at' => Carbon::now(),
                    'updated_by' => 1,
                ];
                Continent::create($continentData);
            } catch (\Throwable $error) {
                Log::error(response()->json([
                        'status' => "FAIL",
                        'message' => 'Creating Continent - '.$continent['name'].' failed at ContinentSeeder',
                        'data' => $continentData,
                        'error' => $error
                    ])
                );
            }
        }
    }
}
