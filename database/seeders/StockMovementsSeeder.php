<?php

namespace Database\Seeders;

use App\Models\BahanBaku;
use App\Models\Customers;
use Illuminate\Database\Seeder;
use App\Models\StokMovements;
use App\Models\RawMaterial;

class StockMovementsSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customers::first();
        $rawMaterial = BahanBaku::first();
        $data = [
            [
                'created_by' => $customers->id,
                'movement_date' => now(),
                'movement_type' => 'out',
                'notes' => 'Digunakan produksi',
                'quantity' => 5,
                'bahan_baku_id' => $rawMaterial->id,
                'reference_id' => 1,
                'reference_type' => 'production',
                'remaining_stock' => 45,
            ],

        ];
        foreach ($data as $d) {
            StokMovements::create([
                'created_by' => $d['created_by'],
                'movement_date' => $d['movement_date'],
                'movement_type' => $d['movement_type'],
                'notes' => $d['notes'],
                'quantity' => $d['quantity'],
                'bahan_baku_id' => $d['bahan_baku_id'],
                'reference_id' => $d['reference_id'],
                'reference_type' => $d['reference_type'],
                'remaining_stock' => $d['remaining_stock'],
            ]);
        }
    }
}
