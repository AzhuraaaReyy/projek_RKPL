<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $table = 'product_types';

    protected $fillable = [
        'name',
        'description',
        'estimated_production_time',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'estimated_production_time' => 'integer',
    ];

    public function sale()
    {
        return $this->hasMany(Sale::class, 'product_type_id');
    }

    public function saleItem()
    {
        return $this->hasMany(SaleItem::class, 'product_type_id');
    }
    public function production()
    {
        return $this->hasMany(Production::class, 'product_type_id');
    }
    // app/Models/ProductType.php

    public function bahanBaku()
    {
        return $this->belongsToMany(BahanBaku::class, 'product_type_raw_material', 'product_type_id', 'bahan_baku_id')
            ->withPivot('quantity_per_unit')
            ->withTimestamps();
    }

    public function getWaktuProduksiFormatAttribute()
    {
        $menit = $this->estimated_production_time;
        $jam = floor($menit / 60);
        $sisaMenit = $menit % 60;

        return "{$jam} jam {$sisaMenit} menit";
        // tampilkan di blade {{ $productType->waktu_produksi_format }}

    }
}
