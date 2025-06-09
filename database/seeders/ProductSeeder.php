<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $products = [
    [
        'user_id' => 6,
        'product_category_id' => 1,
        'image' => 'products/nasi_goreng.jpg',
        'name' => 'Nasi Goreng Spesial',
        'description' => 'Nasi goreng dengan bumbu spesial dan telur mata sapi.',
        'price' => 25000.00,
        'is_popular' => false,
        'rating' => 0,  // <--- tambahkan ini
        'created_at' => now(),
        'updated_at' => now(),
    ]
];

        DB::table('products')->insert($products);
    }
}
