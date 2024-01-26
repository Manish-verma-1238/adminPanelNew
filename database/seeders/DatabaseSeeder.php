<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\admin\AdminNavbarSeeder;
use Database\Seeders\admin\UserSeeder;
use Database\Seeders\admin\UserProfileSeeder;
use Database\Seeders\admin\StateSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminNavbarSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserProfileSeeder::class);
        $this->call(StateSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
