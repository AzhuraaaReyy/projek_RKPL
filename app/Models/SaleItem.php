<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use App\Models\ProductType;
use App\Models\StokMovements;

class SaleItem extends Model
{
    protected $table = 'sale_items';

    protected $fillable = [
        'sale_id',
        'product_type_id',
        'product_name',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    public $timestamps = false;

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'created_at' => 'datetime'
    ];

    protected static function booted()
    {
        static::created(function ($item) {
            $item->reduceBahanBakuStock();
        });
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function reduceBahanBakuStock()
    {
        $productType = $this->productType;

        foreach ($productType->bahanBaku as $bahanBaku) {
            $usedQuantity = $bahanBaku->pivot->quantity_per_unit * $this->quantity;

            $bahanBaku->stok -= $usedQuantity;
            $bahanBaku->save();

            StokMovements::create([
                'bahan_baku_id' => $bahanBaku->id,
                'movement_type' => 'out',
                'quantity' => $usedQuantity,
                'remaining_stock' => $bahanBaku->stok,
                'reference_type' => self::class,
                'reference_id' => $this->id,
                'notes' => 'Pengurangan stok karena penjualan',
                'movement_date' => now(),
                'created_by' => auth()->id() ?? null,
            ]);
        }
    }
}
