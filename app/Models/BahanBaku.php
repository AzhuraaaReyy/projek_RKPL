<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BahanBaku extends Model
{
    use HasFactory;

    protected $table = 'bahan_bakus';

    protected $fillable = [
        'nama',
        'kategori',
        'stok',
        'satuan',
        'minimum_stok',
        'tanggal_masuk',
        'tanggal_kedaluwarsa',
        'harga',
        'deskripsi',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_kedaluwarsa' => 'date',
        'stok' => 'integer',
        'minimum_stok' => 'integer',
        'harga' => 'float',
    ];
    protected $appends = ['status', 'status_class'];


    public function getStatusAttribute()
    {
        $today = Carbon::today();
        $expDate = Carbon::parse($this->tanggal_kedaluwarsa);
        $daysLeft = $today->diffInDays($expDate, false);

        if ($this->stok <= 0) {
            return 'Habis';
        }

        if ($this->stok <= $this->minimum_stok) {
            return 'Stok Menipis';
        }

        if ($expDate->isToday()) {
            return 'Kedaluwarsa Hari Ini';
        }

        if ($expDate->lessThan($today)) {
            return 'Sudah Kedaluwarsa';
        }

        if ($daysLeft <= 3) {
            return 'Akan Kedaluwarsa';
        }

        return 'Aktif';
    }


    public function getStatusClassAttribute()
    {
        if ($this->stok <= 0) {
            return 'danger'; // Habis
        }

        if ($this->stok <= $this->minimum_stok) {
            return 'warning'; // Stok Menipis
        }

        $today = Carbon::today();
        $expDate = Carbon::parse($this->tanggal_kedaluwarsa);
        $daysLeft = $today->diffInDays($expDate, false);

        if ($expDate->isToday()) {
            return 'danger'; // Kedaluwarsa Hari Ini
        }

        if ($expDate->lessThan($today)) {
            return 'dark'; // Sudah Kedaluwarsa
        }

        if ($daysLeft <= 3) {
            return 'warning'; // Akan Kedaluwarsa
        }

        return 'success'; // Aktif
    }


    public function stokMovements()
    {
        return $this->hasMany(StokMovements::class, 'bahan_baku_id');
    }
    public function productTypes()
    {
        return $this->belongsToMany(ProductType::class, 'product_type_raw_material', 'bahan_baku_id', 'product_type_id')
            ->withPivot('quantity_per_unit')
            ->withTimestamps();
    }
    public function getTanggalKadaluwarsaFormatAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_kadaluwarsa)->translatedFormat('d F Y');
    }
}
