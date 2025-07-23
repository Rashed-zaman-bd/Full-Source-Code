<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeedersTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::insert([
            [
                'title' => 'Event 1',
                'description' => 'Event 1 description',
                'start_time' => Carbon::now()->addDays(7),
                'end_time' => Carbon::now()->addDays(7)->addHours(5),
            ],
            [
                'title' => 'Even 2',
                'description' => 'Event 2 description',
                'start_time' => Carbon::now()->addDays(8),
                'end_time' => Carbon::now()->addDays(8)->addHours(5),
            ],
            [
                'title' => 'Event 3',
                'description' => 'Event 3 description',
                'start_time' => Carbon::now()->addDays(9),
                'end_time' => Carbon::now()->addDays(9)->addHours(5),
            ],
        ]);
    }
}
