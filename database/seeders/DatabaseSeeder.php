<?php

namespace Database\Seeders;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role'=>'karyawan'
        ]);


        $this->call([
            UserSeeder::class,
            CustomersSeeder::class,
            bahanbakuSeeder::class,
            ProductTypesSeeder::class,
            ExpenseCategoriesSeeder::class,
            StockMovementsSeeder::class,
            SalesSeeder::class,
            SaleItemsSeeder::class,
            ProductionsSeeder::class,
            ExpensesSeeder::class,


        ]);
    }
}
