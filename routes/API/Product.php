<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductPageController;
Route::get('/', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductPageController::class, 'show'])->name('product.show');


