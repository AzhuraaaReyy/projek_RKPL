<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'quantity_produced' => 200,
                'batch_number' => 'BCH001',
                'production_cost' => 200000,
                'notes' => 'Batch pagi',
                'status' => 'completed',
                'created_by' => 1,
                'created_at' => Carbon::now()
            ],
        ]);
        DB::table('productions')->insert([
            [
                'production_date' => now(),
                'product_type_id' => 2,
                'quantity_produced' => 100,
                'batch_number' => 'BCH001',
                'production_cost' => 200000,
                'notes' => 'Batch pagi',
                'status' => 'completed',
                'created_by' => 1,
                'created_at' => Carbon::now()
            ],
        ]);
        DB::table('productions')->insert([
            [
                'production_date' => now(),
                'product_type_id' => 2,
                'quantity_produced' => 300,
                'batch_number' => 'BCH002',
                'production_cost' => 200000,
                'notes' => 'Batch pagi',
                'status' => 'completed',
                'created_by' => 1,
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
