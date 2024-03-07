<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contact;
use App\Models\ContactType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            DefaultUsersSeeder::class,
            AboutSeeder::class,
            ContactTypeSeeder::class,
            ContactsSeeder::class,
            ContinentSeeder::class,
            CountrySeeder::class,
            CountySeeder::class,
            TownSeeder::class,
            // ServiceSeeder::class,
            // BlogSeeder::class,
            // GallerySeeder::class,
        ]);
    }
}
