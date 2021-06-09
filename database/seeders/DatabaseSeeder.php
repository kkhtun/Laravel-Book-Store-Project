<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            "name"=>"Khaing Khant Htun",
            "email"=>"admin@gmail.com",
            "password"=> Hash::make("bookhub891963")
        ]);

        \App\Models\User::factory()->create([
            "name"=>"User 1",
            "email"=>"user1@gmail.com",
            "password"=> Hash::make("user1@bookhub")
        ]);

        // \App\Models\Category::factory()->has(\App\Models\Book::factory()->count(10))
        // ->count(5)->create();
    }
}
