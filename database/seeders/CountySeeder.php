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
            ['name' => 'Mombasa', 'country_id' => 3, 'shortcode' => 'MBA'],
        ];

        foreach ($counties as $county) {
            County::create([
                'identifier' => generate_identifier(),
                'country_id' => $county['country_id'],
                'name' => $county['name'],
                'shortcode' => $county['shortcode'],
                'active' => $county['name'] == 'Africa',
                'added_by' => 1,
                'activated_by' => 1,
                'activated_at' => Carbon::now(),
                'updated_by' => 1,
            ]);
        }
    }
}
