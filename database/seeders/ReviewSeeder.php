<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $customers = DB::table('customers')
            ->whereIn('email', [
                'john@example.com',
                'jane@example.com',
            ])
            ->pluck('id', 'email');

        $reviews = [
            [
                'customer_email' => 'john@example.com',
                'destination_name' => 'Pokhara',
                'rating' => 5,
                'comment' => 'Amazing views of the mountains and a wonderful travel experience.',
                'travel_date' => '2026-11-15',
            ],
            [
                'customer_email' => 'jane@example.com',
                'destination_name' => 'Chitwan National Park',
                'rating' => 4,
                'comment' => 'Great wildlife experience and friendly local guides.',
                'travel_date' => '2026-12-10',
            ],
            [
                'customer_email' => 'john@example.com',
                'destination_name' => 'Kathmandu',
                'rating' => 5,
                'comment' => 'Loved exploring the temples and local culture.',
                'travel_date' => '2026-09-20',
            ],
        ];

        foreach ($reviews as $review) {
            $customerId = $customers->get(
                $review['customer_email']
            );

            if (!$customerId) {
                continue;
            }

            DB::table('reviews')->updateOrInsert(
                [
                    'customer_id' => $customerId,
                    'destination_name' => $review['destination_name'],
                    'travel_date' => $review['travel_date'],
                ],
                [
                    'rating' => $review['rating'],
                    'comment' => $review['comment'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
