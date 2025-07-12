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
use Illuminate\View\View;

class ProductPageController extends Controller
{
    public function show(Product $product): View
    {
        return view('product.show', [
            'product' => $product->load(['user', 'categories'])
        ]);
    }
}
