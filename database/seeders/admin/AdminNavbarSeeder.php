<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\admin\AdminNavbar;

class AdminNavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminNavbar::create([
            'icon' => '<i class="fas fa-fire"></i>',
            'title' => 'Dashboard',
            'url' => '/dashboard',
        ]);

        AdminNavbar::create([
            'icon' => '<i class="fas fa-th-large"></i>',
            'title' => 'States & UTs',
            'url' => '/states/index',
        ]);

        AdminNavbar::create([
            'icon' => '<i class="fas fa-car"></i>',
            'title' => 'Cabs & Taxis',
            'url' => '/taxis/index',
        ]);

        // $services = AdminNavbar::create([
        //     'icon' => '<i class="fas fa-fire"></i>',
        //     'title' => 'Services',
        //     'url' => '/services',
        // ]);

        // AdminNavbar::create([
        //     'icon' => '<i class="fas fa-fire"></i>',
        //     'title' => 'Web Development',
        //     'url' => '/services/web-development',
        //     'parent_id' => $services->id,
        // ]);

        // AdminNavbar::create([
        //     'icon' => '<i class="fas fa-fire"></i>',
        //     'title' => 'Mobile Development',
        //     'url' => '/services/mobile-development',
        //     'parent_id' => $services->id,
        // ]);
    }
}
