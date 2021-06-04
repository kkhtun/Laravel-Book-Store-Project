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
            "email"=>"user@gmail.com",
            "password"=> Hash::make("password")
        ]);

        \App\Models\Category::factory()->has(\App\Models\Book::factory()->count(5))
        ->count(5)->create();
    }
}
