<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Shop
Route::get('shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::post('shop_create', [App\Http\Controllers\ShopController::class, 'store'])->name('shop.create');
Route::get('shop/show/{id}', [App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');
Route::get("/shop_edit/{id}", [App\Http\Controllers\ShopController::class, "edit"])->name('shop.edit');
Route::post("/shop_update/{id}", [App\Http\Controllers\ShopController::class, "update"])->name('shop.update');
Route::get("/shop_delete/{id}", [App\Http\Controllers\ShopController::class, "destroy"])->name('shop.delete');

// Product
Route::get('product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::post('product_create', [App\Http\Controllers\ProductController::class, 'store'])->name('product.create');
Route::get("/product_edit/{id}", [App\Http\Controllers\ProductController::class, "edit"])->name('product.edit');
Route::post("/product_update/{id}", [App\Http\Controllers\ProductController::class, "update"])->name('product.update');
Route::get("/product_delete/{id}", [App\Http\Controllers\ProductController::class, "destroy"])->name('product.delete');

