<?php

namespace App\Http\Controllers\Product;

use App\Contracts\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resource\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {}

    /**
     * Получить список товаров с пагинацией
     */
    public function index(): JsonResponse
    {
        $products = $this->productService->getPaginatedProducts();

        return response()->json([
            'success' => true,
            'data' => ProductResource::collection($products),
            'meta' => [
                'current_page' => $products->currentPage(),
                'total' => $products->total(),
            ]
        ]);
    }

}
