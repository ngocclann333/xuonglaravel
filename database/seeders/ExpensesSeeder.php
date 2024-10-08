<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('expenses')
            ->insert([
                [
                    'description' => 'Nhập hàng tháng 9',
                    'amount' => 5000000,
                    'expense_date' => '2024-09-05',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'description' => 'Phí vận chuyển',
                    'amount' => 1000000,
                    'expense_date' => '2024-09-10',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'description' => 'Bảo hành sản phẩm',
                    'amount' => 800000,
                    'expense_date' => '2024-09-12',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'description' => 'Lương Nhân viên ',
                    'amount' => 12000000,
                    'expense_date' => '2024-09-30',
                    'created_at' => now(),
                    'updated_at' => now()
                ],

            ]);
    }
}
