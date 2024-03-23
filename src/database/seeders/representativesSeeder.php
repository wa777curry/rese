<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RepresentativesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('representatives')->insert([
            'representativename' => 'イタリアン店舗代表者',
            'email' => 'italy@testmail',
            'password' => Hash::make('password'),
        ]);

        DB::table('representatives')->insert([
            'representativename' => 'ラーメン店舗代表者',
            'email' => 'ramen@testmail',
            'password' => Hash::make('password'),
        ]);

        DB::table('representatives')->insert([
            'representativename' => '居酒屋店舗代表者',
            'email' => 'izakaya@testmail',
            'password' => Hash::make('password'),
        ]);

        DB::table('representatives')->insert([
            'representativename' => '寿司屋店舗代表者',
            'email' => 'sushi@testmail',
            'password' => Hash::make('password'),
        ]);

        DB::table('representatives')->insert([
            'representativename' => '焼肉屋店舗代表者',
            'email' => 'yakiniku@testmail',
            'password' => Hash::make('password'),
        ]);
    }
}
