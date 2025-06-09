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


    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

   
}
