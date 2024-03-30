<?php

namespace Database\Seeders;

use App\Models\Review;
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
        $this->call(UsersSeeder::class);
        $this->call(AdminsSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(GenresSeeder::class);
        $this->call(RepresentativesSeeder::class);
        $this->call(ShopsSeeder::class);
        $this->call(ReservationsSeeder::class);
        $this->call(RatingsSeeder::class);
        $this->call(ReviewsSeeder::class);
    }
}
