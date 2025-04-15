<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);

    Route::middleware(CheckRole::class . ':admin,operador')->group(function () {
        Route::post('/products', [ProductApiController::class, 'store']);
    });

    Route::middleware(CheckRole::class . ':admin')->group(function () {
        Route::put('/products/{product}', [ProductController::class, 'update']);
        Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    });

    Route::middleware(CheckRole::class . ':admin')->group(function () {
        Route::get('/categories', [CategoryApiController::class, 'index']);
        Route::post('/categories', [CategoryApiController::class, 'store']);
        Route::get('/categories/{category}', [CategoryApiController::class, 'show']);
        Route::put('/categories/{category}', [CategoryApiController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryApiController::class, 'destroy']);
    });

});
