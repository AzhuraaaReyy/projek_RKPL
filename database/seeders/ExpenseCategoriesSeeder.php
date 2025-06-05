<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('expense_categories')->insert([
            ['name' => 'Transportasi', 'description' => 'Biaya transport', 'is_active' => true],
            ['name' => 'Listrik', 'description' => 'Biaya listrik bulanan', 'is_active' => true],
        ]);
    }
}
