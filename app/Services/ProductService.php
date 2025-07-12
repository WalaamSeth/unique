<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function getPaginatedProducts(int $perPage = 12): LengthAwarePaginator
    {
        return Product::with(['user', 'categories'])
            ->latest()
            ->paginate($perPage);
    }

    public function getProductDetails(Product $product): Product
    {
        return $product->load(['user', 'categories']);
    }
}
