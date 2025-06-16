<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customers extends Model
{
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

    /**
     * Relasi ke Sales (satu customer bisa punya banyak sales)
     */
    public function sale()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }

    /**
     * Relasi ke sales dengan nama yang lebih jelas
     */
    public function sales()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }

    /**
     * Get total amount spent by customer
     */
    public function getTotalSpentAttribute()
    {
        return $this->sale()->sum('total_amount') ?? 0;
    }

    /**
     * Get total items bought by customer
     */
    public function getTotalItemsAttribute()
    {
        return $this->sale()->with('saleItems')->get()->sum(function($sale) {
            return $sale->saleItems->sum('quantity');
        });
    }

    /**
     * Get total transactions count
     */
    public function getTotalTransactionsAttribute()
    {
        return $this->sale()->count();
    }

    /**
     * Get favorite products with detailed information
     */
    public function getFavoriteProductsListAttribute()
    {
        $allProducts = [];
        $totalItems = 0;
        
        // Kumpulkan semua produk yang dibeli
        foreach ($this->sale()->with('saleItems.productType')->get() as $sale) {
            foreach ($sale->saleItems as $item) {
                $productName = $item->productType->name ?? 'Produk tidak ditemukan';
                $quantity = $item->quantity;
                
                if (isset($allProducts[$productName])) {
                    $allProducts[$productName] += $quantity;
                } else {
                    $allProducts[$productName] = $quantity;
                }
                
                $totalItems += $quantity;
            }
        }
        
        // Sort by quantity (descending)
        arsort($allProducts);
        
        // Convert to collection with detailed info
        $favoriteProducts = collect();
        $ranking = 1;
        
        foreach ($allProducts as $productName => $quantity) {
            $percentage = $totalItems > 0 ? ($quantity / $totalItems) * 100 : 0;
            
            $favoriteProducts->push((object)[
                'ranking' => $ranking,
                'product_name' => $productName,
                'total_quantity' => $quantity,
                'percentage' => round($percentage, 1)
            ]);
            
            $ranking++;
        }
        
        return $favoriteProducts;
    }

    /**
     * Get favorite products (simple array for badges)
     */
    public function getFavoriteProductsAttribute()
    {
        $favoritesList = $this->getFavoriteProductsListAttribute();
        return $favoritesList->take(5)->pluck('product_name')->toArray();
    }

    /**
     * Get last purchase date
     */
    public function getLastPurchaseAttribute()
    {
        $lastSale = $this->sale()->latest('sale_date')->first();
        return $lastSale ? $lastSale->sale_date : null;
    }

    /**
     * Get average purchase amount
     */
    public function getAveragePurchaseAttribute()
    {
        $totalTransactions = $this->getTotalTransactionsAttribute();
        if ($totalTransactions > 0) {
            return $this->getTotalSpentAttribute() / $totalTransactions;
        }
        return 0;
    }

    /**
     * Check if customer is VIP (spent more than 1 million)
     */
    public function getIsVipAttribute()
    {
        return $this->getTotalSpentAttribute() > 1000000;
    }

    /**
     * Get customer status category based on total spent
     */
    public function getStatusCategoryAttribute()
    {
        $totalSpent = $this->getTotalSpentAttribute();
        
        if ($totalSpent > 1000000) {
            return 'VIP';
        } elseif ($totalSpent > 500000) {
            return 'Premium';
        } elseif ($totalSpent > 100000) {
            return 'Regular';
        } else {
            return 'New';
        }
    }

    /**
     * Get recent purchases (last 5)
     */
    public function getRecentPurchasesAttribute()
    {
        return $this->sale()
            ->with(['saleItems.productType'])
            ->latest('sale_date')
            ->take(5)
            ->get();
    }

    /**
     * Scope for active customers
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for inactive customers
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope for VIP customers
     */
    public function scopeVip($query)
    {
        return $query->whereHas('sale', function($q) {
            $q->havingRaw('SUM(total_amount) > ?', [1000000]);
        });
    }

    /**
     * Scope for customers with purchases in last N days
     */
    public function scopeRecentPurchase($query, $days = 30)
    {
        return $query->whereHas('sale', function($q) use ($days) {
            $q->where('sale_date', '>=', Carbon::now()->subDays($days));
        });
    }

    /**
     * Scope for new customers (registered in last N days)
     */
    public function scopeNewCustomers($query, $days = 30)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days));
    }
}