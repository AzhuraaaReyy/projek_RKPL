<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokMovements extends Model
{
    //
    use HasFactory;
    protected $table = 'stock_movements';
    protected $fillable = [
        'bahan_baku_id',
        'movement_type',
        'quantity',
        'remaining_stock',
        'reference_type',

        'notes',
        'movement_date',
        'created_by',
    ];
    public $timestamps = false;
    protected $casts = [
        'quantity' => 'decimal:2',
        'remaining_stock' => 'decimal:2',
        'movement_date' => 'date',
        'created_at' => 'datetime',

    ];
    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }

    // Relasi ke user yang mencatat pergerakan
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
