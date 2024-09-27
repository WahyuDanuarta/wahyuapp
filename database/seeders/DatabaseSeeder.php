<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\distributor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('12345678'),
            'point'=> 10000,
        ]);

        Admin::create([
            'name' => 'admin',
            'username' => 'Admin',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('123456789'),
        ]);

        distributor::create([
            'nama_distributor' => 'tatatata',
            'lokasi' => 'bengkalis1',
            'kontak' => '082243117852',
            'email' => 'distributor11@gmail.com',
        ]);
    }
}