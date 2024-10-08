<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')
            ->insert([
                [
                    'name' => 'Bàn gỗ',
                    'price' => 2000000,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Ghế Xoay',
                    'price' => 1500000,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Tủ Quần áo',
                    'price' => 5000000,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Giường tủ',
                    'price' => 8000000,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]);
    }
}
