<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class representativesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('representatives')->insert([
            'representativename' => '寿司屋店舗代表者',
            'email' => 'sushi@testemail',
            'password' => Hash::make('sushi123'),
        ]);
    }
}
