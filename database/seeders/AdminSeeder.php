<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'logo' => 'default.jpg',
            'name' => 'Admin Warungin',
            'username' => 'admin',
            'email' => 'admin@warungin.com',
            'password' => bcrypt(123),
            'role' => 'admin',
        ]);
    }
}
