<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'brand',
        'price',
        'stock', // Required for lending availability
        'discount_percent',
        'image_path',
        'seller_id', // Link to the seller who owns the item
    ];

    /**
     * The scopeFilter method used by GetFilteredProductsAction.
     * This handles the actual search logic for your shop.
     */
    public function scopeFilter($query, array $filters)
    {
        // Search by name or brand
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('brand', 'like', '%' . $search . '%');
            });
        });

        // Price range filters
        $query->when($filters['min_price'] ?? null, function ($query, $price) {
            $query->where('price', '>=', $price);
        });

        $query->when($filters['max_price'] ?? null, function ($query, $price) {
            $query->where('price', '<=', $price);
        });
    }

    /**
     * Relationship: A product belongs to a seller.
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}