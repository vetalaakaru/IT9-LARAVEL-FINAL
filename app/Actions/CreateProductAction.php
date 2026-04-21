<?php

namespace App\Actions;

use App\Models\Product;

class CreateProductAction
{
    public function execute(array $data)
    {
        return Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'stock' => $data['stock'] ?? 0, 
            'image_path' => $data['image_path'] ?? null,
            'brand' => $data['brand'] ?? 'CraveCart', 
            'discount_percent' => $data['discount_percent'] ?? 0,
        ]);
    }
}