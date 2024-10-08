<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('taxes')
            ->insert([
                [
                    'tax_name' => 'VAT',
                    'rate' => 10,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
    }
}
