<?php

namespace Database\Seeders;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [
            [
                'name' => 'Email',
                'contact_type_id' => 1,
                'value' => 'info@acedivingmarine.com'
            ], [
                'name' => 'Primary Phone Number',
                'contact_type_id' => 2,
                'value' => '254794601226'
            ], [
                'name' => 'Instagram',
                'contact_type_id' => 3,
                'value' => 'https://instagram.com/acedivingmarine'
            ], [
                'name' => 'Facebook',
                'contact_type_id' => 3,
                'value' => 'https://facebook.com/acedivingmarine'
            ], [
                'name' => 'Twitter',
                'contact_type_id' => 3,
                'value' => 'https://twitter.com/acedivingmarine'
            ], [
                'name' => 'TikTok',
                'contact_type_id' => 3,
                'value' => 'https://tiktok.com/acedivingmarine'
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create(
                [
                    'identifier' => generate_identifier(),
                    'name' => $contact['name'],
                    'value' => $contact['value'],
                    'contact_type_id' => $contact['contact_type_id'],
                    'added_by' => 1,
                    'activated_by' => 1,
                    'updated_by' => 1,
                    'activated_at' => Carbon::now(),
                ],
            );
        }
    }
}
