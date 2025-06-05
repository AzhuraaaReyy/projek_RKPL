<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sales')->insert([
            [
                'sale_date' => now(),
                'customer_id' => null,
                'customer_name' => 'Umum',
                'total_amount' => 50000,
                'payment_method' => 'cash',
                'payment_status' => 'paid',
                'notes' => 'Penjualan toko',
                'created_by' => 1,
            ],
        ]);
    }
}
