<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\testController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', [ProductController::class, 'home']) -> name('homepage');

Route::get('/apple', [ProductController::class, 'index']) -> name('apple');
Route::get('/samsung', [ProductController::class, 'index']) -> name('samsung');
Route::get('/huawei', [ProductController::class, 'index']) -> name('huawei');
Route::get('/xiaomi', [ProductController::class, 'index']) -> name('xiaomi');
Route::get('/oneplus', [ProductController::class, 'index']) -> name('oneplus');
Route::get('/lg', [ProductController::class, 'index']) -> name('lg');
Route::get('/accessories', [ProductController::class, 'index']) -> name('accessories');

Route::resource('product', ProductController::class);
Route::get('/autocomplete', [ProductController::class, 'autocomplete'])->name('autocomplete');
Route::get('/product-search', [ProductController::class, 'showProductByName'])->name('searchProduct');

Route::get('/add-item-to-cart/{id}', [ProductController::class, 'addItemToCart'])->name('addItemToCart');
Route::get('/add-one-item-to-cart/{id}', [ProductController::class, 'addOneItemToCart'])->name('addOneItemToCart');
Route::get('/remove-item-from-cart/{id}', [ProductController::class, 'removeItemFromCart'])->name('removeItemFromCart');
Route::get('/remove-one-item-from-cart/{id}', [ProductController::class, 'removeOneItemToCart'])->name('removeOneItemToCart');
Route::get('/get-shopping-cart-1', [ProductController::class, 'getShoppingCart1'])->name('getShoppingCart1');
Route::get('/get-shopping-cart-1/get-shopping-cart-2', [ProductController::class, 'getShoppingCart2'])->name('getShoppingCart2');
Route::get('/get-shopping-cart-1/get-shopping-cart-2/get-shopping-cart-3', [ProductController::class, 'getShoppingCart3'])->name('getShoppingCart3');
Route::post('/get-shopping-cart-1/get-shopping-cart-2/get-shopping-cart-3/order-confirmation', [ProductController::class, 'getOrderConfirmation'])->name('getOrderConfirmation');
Route::get('/get-shopping-cart-1/get-shopping-cart-2/transport-type/{type}', [ProductController::class, 'getTransportType'])->name('transportType');

Auth::routes();

Route::middleware(['auth', 'isAdmin'])->group(function() {
    Route::resource('admin', AdminController::class);
});
