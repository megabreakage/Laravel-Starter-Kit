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
            ['name' => 'Westlands', 'county_id' => 1, 'shortcode' => 'WST'],
            ['name' => 'Parklands', 'county_id' => 1, 'shortcode' => 'PRK']
        ];

        foreach ($towns as $town) {
            Town::create([
                'identifier' => generate_identifier(),
                'county_id' => $town['county_id'],
                'name' => $town['name'],
                'shortcode' => $town['shortcode'],
                'active' => $town['name'] == 'Africa',
                'added_by' => 1,
                'activated_by' => 1,
                'activated_at' => Carbon::now(),
                'updated_by' => 1,
            ]);
        }
    }
}
