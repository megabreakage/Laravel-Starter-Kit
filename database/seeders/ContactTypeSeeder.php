<?php

namespace Database\Seeders;

use App\Models\ContactType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact_types = [
            'email', 'phone number', 'social', 'fax', 'postal'
        ];

        foreach ($contact_types as $contact_type) {
            ContactType::create([
                'identifier' => generate_identifier(),
                'name' => $contact_type,
                'added_by' => 1,
            ]);
        }
    }
}
