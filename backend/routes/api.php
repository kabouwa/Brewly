<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



// Categories Resource
Route::apiResource('categories', CategoryController::class);
Route::patch('categories/{category}/toggle', [CategoryController::class,'toggle'])->name('categories.toggle');

// Product Resource
Route::apiResource('products', ProductController::class);
Route::patch('products/{product}/toggle', [ProductController::class,'toggle'])->name('products.toggle');
