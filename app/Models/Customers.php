<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'address',
        'is_active',
        'last_purchase_date'

    ];
    protected $casts = [
        'is_active' => 'boolean',
        'last_purchase_date' => 'date'
    ];

    public function sale()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }
}
