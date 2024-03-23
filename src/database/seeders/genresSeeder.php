<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'genre_name' => 'イタリアン',
            'image_url' => asset('images/tejofOSR43VYFjL6E3hyoTMcVEwJyQOcEm0iDmkv.jpg'),
        ]);

        DB::table('genres')->insert([
            'genre_name' => 'ラーメン',
            'image_url' => asset('images/xfHfq7pKnMS7BHUnF2CKd58wveGh3oiu7HwXz7QI.jpg'),
        ]);

        DB::table('genres')->insert([
            'genre_name' => '居酒屋',
            'image_url' => asset('images/0KoChTAy0qOBSdgKoVyMBPNTbHO0JKZ4zXBadX3V.jpg'),
        ]);

        DB::table('genres')->insert([
            'genre_name' => '寿司',
            'image_url' => asset('images/Xhr9jWEuMQTk8k1RMsDzPzS3c9eHZJ0LoAO6zeXy.jpg'),
        ]);

        DB::table('genres')->insert([
            'genre_name' => '焼肉',
            'image_url' => asset('images/aJb1DlgrbLNvDBosYdpDSpOZCVJsE2GKc3YzKRL5.jpg'),
        ]);
    }
}
