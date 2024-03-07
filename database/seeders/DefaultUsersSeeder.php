<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder
{

    public function run(): void
    {
        $users = [
            [
                'firstname' => 'Admin',
                'lastname' => 'User',
                'email' => 'asa@acedivingmarine.com',
                'phone_number' => '0794601226',
                'password' => 'A.Gamble@2024',
                'role' => 'admin'
            ], [
                'firstname' => 'Normal',
                'lastname' => 'User',
                'email' => 'user@user.com',
                'phone_number' => '0711222444',
                'password' => 'secret_password',
                'role' => 'user'
            ]
        ];

        foreach ($users as $user) {
            $record = User::create(
                [
                    'identifier' => generate_identifier(),
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'email' => $user['email'],
                    'phone_number' => $user['phone_number'],
                    'password' => Hash::make($user['password'])
                ]
            );

            $record->assignRole($user['role']);
        }
    }
}
