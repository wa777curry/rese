<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(adminsSeeder::class);
        $this->call(areasSeeder::class);
        $this->call(genresSeeder::class);
        $this->call(reservationsSeeder::class);
        $this->call(shopsSeeder::class);
        $this->call(usersSeeder::class);
    }
}
