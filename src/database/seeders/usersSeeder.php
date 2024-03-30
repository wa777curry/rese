<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' =>'テスト太郎',
            'email' => 'test@testmail',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
        ]);

        User::factory()->count(9)->create();
    }
}
