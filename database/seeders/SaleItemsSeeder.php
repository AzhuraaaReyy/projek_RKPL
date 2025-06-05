<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleItemsSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah product type dengan ID 1 ada
        $productTypeExists = DB::table('product_types')->where('id', 1)->exists();
        
        if (!$productTypeExists) {
            echo "Product type dengan ID 1 tidak ditemukan. Seeder SaleItems dilewati.\n";
            return;
        }

        // Pastikan sale dengan ID 1 ada
        $saleExists = DB::table('sales')->where('id', 1)->exists();
        if (!$saleExists) {
            echo "Sale dengan ID 1 tidak ditemukan. Seeder SaleItems dilewati.\n";
            return;
        }

        DB::table('sale_items')->insert([
            [
                'sale_id' => 1,
                'product_type_id' => 1,
                'product_name' => 'Roti Tawar',
                'quantity' => 10,
                'unit_price' => 5000,
                'subtotal' => 50000,
            ],
        ]);
    }
}