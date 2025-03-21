<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class,'index'])->name('main');

Route::get('/cart', [ProductController::class,'cart'])->name('cart');

Route::get('/product/{id}', [ProductController::class,'productById'])->name('product-by-id');

Route::post('/make-order', [OrderController::class, 'makeOrder'])->name('make-order');