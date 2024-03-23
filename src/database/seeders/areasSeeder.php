<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            'area_name' => '東京',
        ]);

        DB::table('areas')->insert([
            'area_name' => '大阪',
        ]);

        DB::table('areas')->insert([
            'area_name' => '福岡',
        ]);
    }
}
