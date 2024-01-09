<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'firstname' => 'Admin',
                'lastname' => 'User',
                'email' => 'admin@admin.com',
                'phone_number' => '0711222333',
                'password' => 'password',
                'role' => 'admin'
            ],
            [
                'firstname' => 'Normal',
                'lastname' => 'User',
                'email' => 'user@user.com',
                'phone_number' => '0711222444',
                'password' => 'password',
                'role' => 'user'
            ]
            ];

            foreach($users as $user){
                $record = User::query()->updateOrCreate([
                    'email' => $user['email'],
                    'phone_number' => $user['phone_number'],
                ],
                [
                    'identifier' => generate_identifier(),
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'password' => Hash::make($user['password'])
                ]);

                $record->assignRole($user['role']);
            }
    }
}
