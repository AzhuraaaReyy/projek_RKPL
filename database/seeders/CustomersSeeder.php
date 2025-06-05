<?php

namespace Database\Seeders;

use App\Models\Customers;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'name' => 'mariadi',
                'phone' => '08313341720',
                'address' => 'ungaran',
                'is_active' => true,
                'last_purchase_date' => Carbon::now()
            ],

        ];
        foreach ($data as $d) {
            Customers::create([
                'name' => $d['name'],
                'phone' => $d['phone'],
                'address' => $d['address'],
                'is_active' => $d['is_active'],
                'last_purchase_date' => $d['last_purchase_date'],

            ]);
        }
    }
}
