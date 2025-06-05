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
        if ($daysLeft <= 3) {
            return 'Akan Kedaluwarsa';
        }
        return 'Aktif';
    }

    public function getStatusClassAttribute()
    {
        if ($this->stok <= 0) {
            return 'danger';
        }
        if ($this->stok <= $this->minimum_stok) {
            return 'warning';
        }

        $today = Carbon::today();
        $expDate = Carbon::parse($this->tanggal_kedaluwarsa);
        $daysLeft = $today->diffInDays($expDate, false);

        if ($daysLeft <= 3) {
            return 'warning';
        }
        return 'success';
    }

    public function stokMovements()
    {
        return $this->hashMany(StokMovements::class, 'bahan_baku_id');
    }
    public function productTypes()
    {
        return $this->belongsToMany(ProductTypes::class, 'product_type_raw_material', 'bahan_baku_id', 'product_type_id')
            ->withPivot('quantity_per_unit')
            ->withTimestamps();
    }
}
