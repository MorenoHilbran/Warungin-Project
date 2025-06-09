<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $stores = [
            [
                'name' => 'Kebuli Ajibarang',
                'username' => 'kebuliajb',
                'email' => 'kebuliajb@warungin.com',
            ],
            [
                'name' => 'Sego Kiplik',
                'username' => 'segokiplik',
                'email' => 'segokiplik@warungin.com',
            ],
            [
                'name' => 'Geprek Redjo',
                'username' => 'geprekredjo',
                'email' => 'geprekredjo@warungin.com',
            ],
            [
                'name' => 'Bakso Sami Asih',
                'username' => 'samiasih',
                'email' => 'samiasih@warungin.com',
            ],
            [
                'name' => 'Warung Biru',
                'username' => 'warbir',
                'email' => 'warbir@warungin.com',
            ],
        ];

        foreach ($stores as $store) {
            User::create([
                'logo' => 'default.jpg',
                'name' => $store['name'],
                'username' => $store['username'],
                'email' => $store['email'],
                'password' => Hash::make('123'), // default password
                'role' => 'store',
            ]);
        }
    }
}
