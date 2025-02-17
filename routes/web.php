<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login-user',[LoginController::class,'login'])->name('login_user');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/products', [ProductsController::class, 'index'])->name('products');
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/products/{id}', [ProductsController::class, 'productById'])->name('productById');
    Route::get('/products-show/{id}', [ProductsController::class, 'showproductById'])->name('showproductById');
    
    Route::prefix('api')->group(function () {
        Route::get('/getProducts', [ProductsController::class, 'getProducts'])->name('api.getProducts');
        Route::get('/searchProducts', [ProductsController::class, 'searchProducts'])->name('api.searchProducts');
        Route::post('/addProducts', [ProductsController::class, 'addProducts'])->name('api.addProducts');
        Route::get('/getproducts/{id}', [ProductsController::class, 'getApiProducts'])->name('api.getApiProducts');
        Route::post('/updateproduct/{id}', [ProductsController::class, 'updateproduct'])->name('api.updateproduct');
        Route::delete('/deleteproduct/{id}', [ProductsController::class, 'deleteproduct'])->name('api.deleteproduct');
        Route::get('/getCategory', [CategoryController::class, 'getCategory'])->name('api.getCategory');
    });
    

});