<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookingSeedersTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::insert([
            [
            'user_id' => 3,
            'event_id' => 1,
            'ticket_qty' => 2,
            'total_price' => 500,
            'status' => 'pending',
            ],
            [
            'user_id' => 4,
            'event_id' => 2,
            'ticket_qty' => 3,
            'total_price' => 2100,
            'status' => 'pending',
            ],
            [
            'user_id' => 4,
            'event_id' => 2,
            'ticket_qty' => 4,
            'total_price' => 2800,
            'status' => 'pending',
            ],
            [
            'user_id' => 5,
            'event_id' => 3,
            'ticket_qty' => 1,
            'total_price' => 3000,
            'status' => 'confirmed',
            ],
        ]);
    }
}
