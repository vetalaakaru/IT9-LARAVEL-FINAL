<?php

namespace App\Actions;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class GetFilteredProductsAction
{
    /**
     * Retrieves products based on search and filter criteria.
     * Requires scopeFilter to be defined in your Product model.
     * * @param array $filters
     * @return LengthAwarePaginator
     */
    public function execute(array $filters): LengthAwarePaginator
    {
        // Product::filter($filters) calls the scopeFilter method in the Product model.
        return Product::filter($filters) 
            ->latest()
            ->paginate(9); // Returns 9 items per page for the shop grid.
    }
}