<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '9800000001',
                'address' => 'Kathmandu, Nepal',
                'country' => 'Nepal',
                'date_of_birth' => '1995-05-15',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '9800000002',
                'address' => 'Pokhara, Nepal',
                'country' => 'Nepal',
                'date_of_birth' => '1998-08-20',
            ],
        ];

        foreach ($customers as $customer) {
            DB::table('customers')->updateOrInsert(
                ['email' => $customer['email']],
                [
                    ...$customer,
                    'email_verified_at' => now(),
                    'password' => Hash::make('password123'),
                    'remember_token' => null,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
