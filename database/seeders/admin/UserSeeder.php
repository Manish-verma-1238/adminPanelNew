<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Manish Verma',
            'email' => 'manishkverma1999@gmail.com',
            'password' => bcrypt('admin@2023'),
            'user_type' => 'super-admin'
        ]);
    }
}
