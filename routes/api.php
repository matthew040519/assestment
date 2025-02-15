<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    // Add your routes here
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/getProducts', [ProductsController::class, 'getProducts']);
    });
});
