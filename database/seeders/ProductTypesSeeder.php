<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypesSeeder extends Seeder
{
    public function run(): void
    {
        $productTypes = [
            [
                'id' => 1,
                'name' => 'Bakery',
                'description' => 'Produk roti dan kue',
            ],
            [
                'id' => 2,
                'name' => 'Beverage',
                'description' => 'Minuman',
            ],
        ];

        foreach ($productTypes as $productType) {
            DB::table('product_types')->updateOrInsert(
                ['id' => $productType['id']], // Kondisi untuk cek
                $productType // Data yang akan diinsert/update
            );
        }
    }
}