<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpensesSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah expense category dengan ID 1 ada
        $categoryExists = DB::table('expense_categories')->where('id', 1)->exists();
        
        if (!$categoryExists) {
            echo "Expense category dengan ID 1 tidak ditemukan. Seeder Expenses dilewati.\n";
            return;
        }

        // Cek apakah user dengan ID 1 ada
        $userExists = DB::table('users')->where('id', 1)->exists();
        
        if (!$userExists) {
            echo "User dengan ID 1 tidak ditemukan. Seeder Expenses dilewati.\n";
            return;
        }

        DB::table('expenses')->insert([
            [
                'expense_category_id' => 1,
                'description' => 'Ongkos kirim bahan baku',
                'amount' => 50000,
                'expense_date' => now(),
                'receipt_number' => 'TRX001',
                'notes' => 'Dikirim via Gojek',
                'created_by' => 1,
            ],
        ]);
    }
}