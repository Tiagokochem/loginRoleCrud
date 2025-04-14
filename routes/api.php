<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);

    Route::middleware(CheckRole::class . ':admin,operador')->group(function () {
        Route::post('/products', [ProductController::class, 'store']);
    });

    Route::middleware(CheckRole::class . ':admin')->group(function () {
        Route::put('/products/{product}', [ProductController::class, 'update']);
        Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    });
});
