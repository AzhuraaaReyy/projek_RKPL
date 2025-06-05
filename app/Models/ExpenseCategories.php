<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategories extends Model
{
    //
    protected $table = 'expense_categories';
    protected $fillable = [
        'name',
        'description',
        'is_active',
        
    ];

    public $timestamps = false;
    protected $casts = [
        'is_active'=> 'boolean',
        'created_at' => 'datetime'
    ];

    public function expenses()
    {
        return $this->hasMany(Expenses::class, 'expense_category_id');
    }
}
