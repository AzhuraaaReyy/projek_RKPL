<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'sale_date',
        'customer_id',
        'customer_name',
        'total_amount',
        'payment_method',
        'payment_status',
        'notes',
        'created_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'sale_date' => 'date',
        'total_amount' => 'float',
    ];


    /**
     * Relasi ke customer (jika ada).
     */
    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    /**
     * Relasi ke user (pembuat data).
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function salesItems()
    {
        return $this->hasMany(SalesItems::class, 'sale_id');
    }
}
