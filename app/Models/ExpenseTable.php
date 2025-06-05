<?php

namespace App\Models;

use App\Models\ExpenseCategories;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Expenses extends Model
{
    //
    protected $fillable = [
        'expense_category_id',
        'description',
        'amount',
        'expense_date',
        'receipt_number',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
    ];

    // Relasi ke kategori pengeluaran
    public function category()
    {
        return $this->belongsTo(ExpenseCategories::class, 'expense_category_id');
    }

    // Relasi ke user yang membuat pengeluaran
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
