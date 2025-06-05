<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BahanBaku;
use Illuminate\Support\Carbon;

class bahanbakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'banana',
                'kategori' => 'pisang',
                'stok' => '2',
                'satuan' => 'kg',
                'minimum_stok' => '5',
                'tanggal_masuk' => Carbon::now(),
                'tanggal_kedaluwarsa' => Carbon::now()->addDays(7),
                'harga'=> 5000,
                'deskripsi'=>'tepung terigu enak'
            ],
            [
                'nama' => 'roti bolu',
                'kategori' => 'manisan',
                'stok' => '10',
                'satuan' => 'kg',
                'minimum_stok' => '5',
                'tanggal_masuk' => Carbon::now(),
                'tanggal_kedaluwarsa' => Carbon::now()->addDays(7),
                'harga'=> 6000,
                'deskripsi'=>'Roti enak'
            ],
        ];
        foreach ($data as $d) {
            BahanBaku::create([
                'nama' => $d['nama'],
                'kategori' => $d['kategori'],
                'stok' => $d['stok'],
                'satuan' => $d['satuan'],
                'minimum_stok' => $d['minimum_stok'],
                'tanggal_masuk' => $d['tanggal_masuk'],
                'tanggal_kedaluwarsa' => $d['tanggal_kedaluwarsa'],
                'harga'=> $d['harga'],
                'deskripsi'=> $d['deskripsi'],
            ]);
        }
    }
}
