<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        try {
            About::create([
                'identifier' => generate_identifier(),
                'name' => 'About',
                'description' => 'Dubois Safaris is a renowned safari tours and travel company that provides exclusive and intimate safaris ranging from Luxury, Mid-range and Budget across world’s famous safari countries, Kenya, Tanzania, Uganda and Rwanda since 2009. Whether you are looking for a private, family, group, corporate or special interest safari our professional team is always ready to give an authentic and memorable African experience.',
                'mission' => 'Dubois Safaris is a renowned safari tours and travel company',
                'vision' => 'Dubois Safaris is a renowned safari tours and travel company',
                'core_values' => 'Dubois Safaris is a renowned safari tours and travel company',
                'added_by' => 1,
            ]);
        } catch (\Throwable $th) {
            throw $th;
            Log::error(response()->json($th->getMessage()));
        }
    }
}
