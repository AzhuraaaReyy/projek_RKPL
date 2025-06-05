<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productions')->insert([
            [
                'production_date' => now(),
                'product_type_id' => 1,
                'quantity_produced' => 100,
                'batch_number' => 'BCH001',
                'production_cost' => 200000,
                'notes' => 'Batch pagi',
                'status' => 'completed',
                'created_by' => 1,
            ],
        ]);
    }
}
