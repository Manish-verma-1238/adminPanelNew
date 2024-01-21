<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publicPath = public_path();
        // Concatenate the relative path to your image
        $imagePath = $publicPath . '\assets\admin\assets\img\avatar\avatar-5.png';

        DB::table('users_profiles')->insert([
            'phone' => '9988776655',
            'panel_name' => 'Admins Panel',
            'panel_logo' => $imagePath,
            'about' => 'I am the owner of this admin panel.',
            'user_id' => 1
        ]);
    }
}
