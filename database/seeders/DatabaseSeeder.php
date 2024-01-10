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
            // ContinentSeeder::class,
            // CountrySeeder::class,
            // CountySeeder::class,
            // TownSeeder::class,
            // CategorySeeder::class,
            // DestinationSeeder::class,
            // HotelSeeder::class,
            // PackageSeeder::class,
            // ServiceSeeder::class,
            // AddressSeeder::class,
            // MemberSeeder::class,
            // ReviewSeeder::class,
            // BookingSeeder::class,
            // TransactionTypeSeeder::class,
            // TransactionRequestResponseSeeder::class,
            // TransactionSeeder::class,
            // BlogSeeder::class,
            // GallerySeeder::class,
       ]);
    }
}
