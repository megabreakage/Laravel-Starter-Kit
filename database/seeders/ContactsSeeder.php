<?php

namespace Database\Seeders;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'name' => 'Email',
                'contact_type_id' => 1,
                'value' => 'info@royalchoicetravel.com'
            ],[
                'name' => 'Primary Phone Number',
                'contact_type_id' => 2,
                'value' => '254783027111 '
            ],[
                'name' => 'Email',
                'contact_type_id' => 1,
                'value' => 'deals@royalchoicetravel.com'
            ],[
                'name' => 'Instagram',
                'contact_type_id' => 3,
                'value' => 'https://instagram.com/royalchoicetravel'
            ],[
                'name' => 'Facebook',
                'contact_type_id' => 3,
                'value' => 'https://facebook.com/royalchoicetravel'
            ],[
                'name' => 'Twitter',
                'contact_type_id' => 3,
                'value' => 'https://twitter.com/royalchoiceKE'
            ],[
                'name' => 'TikTok',
                'contact_type_id' => 3,
                'value' => 'https://tiktok.com/royalchoicetravel'
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::query()->updateOrCreate(
                ['value' => $contact['value']],
                [
                    'identifier' => generate_identifier(),
                    'name' => $contact['name'],
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
