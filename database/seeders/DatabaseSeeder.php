<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Customer::factory(1000)->create();

        \App\Models\User::factory()->create([
            'name' => 'Developer',
            'username' => 'developer',
            'email' => 'developer@gmail.com',
            'password' => bcrypt('developer'),
        ]);
    }
}
