<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use App\Models\ProductType;

class SalesItems extends Model
{
    //
    protected $table = 'sale_items';
    protected $fillable = [
        'sale_id',
        'product_type_id',
        'product_name',
        'quantity',
        'unit_price',
        'subtotal',

    ];
    protected static function booted()
    {
        static::created(function ($item) {
            $item->reduceBahanBakuStock();
        });
    }

    protected $timestamp = false;

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'created_at' => 'datetime'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    // Relasi ke tipe produk
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    // app/Models/SalesItems.php

    public function reduceBahanBakuStock()
    {
        $productType = $this->productType;

        foreach ($productType->bahanBakus as $bahanBaku) {
            $usedQuantity = $bahanBaku->pivot->quantity_per_unit * $this->quantity;

            // Kurangi stok bahan baku
            $bahanBaku->stok -= $usedQuantity;
            $bahanBaku->save();

            // Catat pergerakan stok
            \App\Models\StokMovements::create([
                'bahan_baku_id' => $bahanBaku->id,
                'movement_type' => 'out',
                'quantity' => $usedQuantity,
                'remaining_stock' => $bahanBaku->stok,
                'reference_type' => \App\Models\SalesItems::class,
                'reference_id' => $this->id,
                'notes' => 'Pengurangan stok karena penjualan',
                'movement_date' => now(),
                'created_by' => auth()->id() ?? null,
            ]);
        }
    }
}
