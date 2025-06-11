<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'purwanti',
                'email' => 'purcantik@gmail.com',
                'password' => 'mbakpur',
                'role' => 'admin'
            ],
            [
                'name' => 'andhika',
                'email' => 'andhika_ganteng@gmail.com',
                'password' => '123456',
                'role' => 'karyawan'
            ],
        ];
        foreach ($data as $d) {
            User::create([
                'name' => $d['name'],
                'email' => $d['email'],
                'password' => $d['password'],
                'role' => $d['role']
            ]);
        }
    }
}
