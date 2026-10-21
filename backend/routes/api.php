<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Authentication\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // Authentication
    Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('throttle:5,1');

    Route::middleware(['auth:sanctum','throttle:60,1'])->group(function () {

        Route::get('/user', [AuthController::class, 'user'])->name('user');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Categories Resource
        Route::apiResource('users', UserController::class);
        Route::patch('/users/{user}/password', [UserController::class,'updatePassword'])->name('users.password');

        // Categories Resource
        Route::apiResource('categories', CategoryController::class);
        Route::patch('categories/{category}/toggle', [CategoryController::class,'toggle'])->name('categories.toggle');

        // Product Resource
        Route::apiResource('products', ProductController::class);
        Route::patch('products/{product}/toggle', [ProductController::class,'toggle'])->name('products.toggle');

        // Order Resource
        Route::apiResource('orders', OrderController::class);
        Route::patch('orders/{order}/status', [OrderController::class, 'status'])->name('orders.status');;

        // Order Item Resource
        Route::apiResource('order-items', OrderItemController::class);
    });
});
