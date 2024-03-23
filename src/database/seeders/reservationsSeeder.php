<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            'user_id' => 1,
            'shop_id' => 1,
            'reservation_date' => '2024-01-20',
            'reservation_time' => '10:00',
            'reservation_number' => '2',
        ]);

        DB::table('reservations')->insert([
            'user_id' => 1,
            'shop_id' => 2,
            'reservation_date' => '2024-01-16',
            'reservation_time' => '10:00',
            'reservation_number' => '3',
        ]);

        DB::table('reservations')->insert([
            'user_id' => 1,
            'shop_id' => 3,
            'reservation_date' => '2024-01-15',
            'reservation_time' => '10:00',
            'reservation_number' => '2',
        ]);
    }
}
