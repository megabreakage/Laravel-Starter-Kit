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
        About::create([
            'identifier' => generate_identifier(),
            'name' => 'About',
            'description' => 'A leading provider of marine construction and infrastructure support services',
            'mission' => 'A leading provider of marine construction and infrastructure support services',
            'vision' => 'A leading provider of marine construction and infrastructure support services',
            'core_values' => 'A leading provider of marine construction and infrastructure support services',
            'added_by' => 1,
        ]);
    }
}
