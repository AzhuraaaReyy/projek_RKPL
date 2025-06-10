<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'production_date',
        'product_type_id',
        'quantity_produced',
        'batch_number',
        'production_cost',
        'notes',
        'status',
        'created_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'production_date' => 'date',
        'quantity_produced' => 'integer',
        'production_cost' => 'float',
        'created_by' => 'integer',
    ];


    /**
     * Relationships
     */

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    protected static function booted()
    {
        static::created(function ($production) {
            if ($production->status === 'completed') {
                $production->reduceRawMaterials();
            }
        });

        static::updated(function ($production) {
            if ($production->isDirty('status') && $production->status === 'completed') {
                $production->reduceRawMaterials();
            }
        });
    }
    public function reduceRawMaterials()
    {
        $productType = $this->productType;

        foreach ($productType->bahanBaku as $bahanBaku) {
            $jumlahDiperlukan = $bahanBaku->pivot->quantity_per_unit * $this->quantity_produced;

            // Kurangi stok, tapi pastikan tidak minus
            $jumlahDikurangi = min($jumlahDiperlukan, $bahanBaku->stok);
            $bahanBaku->stok -= $jumlahDikurangi;
            $bahanBaku->save();


            \App\Models\StokMovements::create([
                'bahan_baku_id' => $bahanBaku->id,
                'movement_type' => 'out',
                'quantity' => $jumlahDikurangi,
                'remaining_stock' => $bahanBaku->stok,
                'reference_type' => 'production',
                'reference_id' => $this->id,
                'notes' => 'Pengurangan stok karena produksi',
                'movement_date' => now(),
                'created_by' => auth()->id() ?? null,
            ]);
        }
    }

    public function getStatusClassAttribute()
    {
        return match ($this->getRawOriginal('status')) {
            'planning' => 'warning',
            'completed' => 'success',
            'cancelled' => 'danger',
            default => 'warning',
        };
    }
}
