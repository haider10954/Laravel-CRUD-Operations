<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
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
    return view('product');
})->name('products');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');

Route::get('/category', function () {
    return view('category');
})->name('categories');

// Route::get('/edit-product', function () {
//     return view('products.edit_product');
// })->name('edit-product');

Route::get('/product-category', function () {
    return view('category.category');
})->name('category');

Route::resource('category',CategoryController::class);
Route::resource('product',ProductController::class);
Route::resource('customer',CustomerController::class);