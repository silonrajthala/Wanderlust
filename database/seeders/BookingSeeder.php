<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $customers = DB::table('customers')
            ->whereIn('email', [
                'john@example.com',
                'jane@example.com',
            ])
            ->pluck('id', 'email');

        $bookings = [
            [
                'customer_email' => 'john@example.com',
                'destination_name' => 'Pokhara',
                'travel_date' => '2026-11-15',
                'travelers' => 2,
                'special_requests' => 'Hotel with mountain view',
                'status' => 'confirmed',
                'total_price' => 25000.00,
            ],
            [
                'customer_email' => 'jane@example.com',
                'destination_name' => 'Chitwan National Park',
                'travel_date' => '2026-12-10',
                'travelers' => 3,
                'special_requests' => null,
                'status' => 'pending',
                'total_price' => 18000.00,
            ],
        ];

        foreach ($bookings as $booking) {
            $customerId = $customers->get(
                $booking['customer_email']
            );

            if (!$customerId) {
                continue;
            }

            DB::table('bookings')->updateOrInsert(
                [
                    'customer_id' => $customerId,
                    'destination_name' => $booking['destination_name'],
                    'travel_date' => $booking['travel_date'],
                ],
                [
                    'travelers' => $booking['travelers'],
                    'special_requests' => $booking['special_requests'],
                    'status' => $booking['status'],
                    'total_price' => $booking['total_price'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
