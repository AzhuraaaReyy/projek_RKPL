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
        return $this->belongsTo(ProductTypes::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
