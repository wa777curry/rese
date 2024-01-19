<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class imagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            'image_name' => 'イタリアン',
            'image_url' => asset('storage/images/tejofOSR43VYFjL6E3hyoTMcVEwJyQOcEm0iDmkv.jpg'),
        ]);

        DB::table('shops')->insert([
            'image_name' => 'ラーメン',
            'image_url' => asset('storage/images/xfHfq7pKnMS7BHUnF2CKd58wveGh3oiu7HwXz7QI.jpg'),
        ]);

        DB::table('shops')->insert([
            'image_name' => '居酒屋',
            'image_url' => asset('storage/images/0KoChTAy0qOBSdgKoVyMBPNTbHO0JKZ4zXBadX3V.jpg'),
        ]);

        DB::table('shops')->insert([
            'image_name' => '寿司',
            'image_url' => asset('storage/images/Xhr9jWEuMQTk8k1RMsDzPzS3c9eHZJ0LoAO6zeXy.jpg'),
        ]);

        DB::table('shops')->insert([
            'image_name' => '焼肉',
            'image_url' => asset('storage/images/aJb1DlgrbLNvDBosYdpDSpOZCVJsE2GKc3YzKRL5.jpg'),
        ]);
    }
}
