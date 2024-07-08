<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::post('/', [HomeController::class, 'homePost'])->name('home.post');
Route::get('/get-shipping-methods-by-country/{id}', [HomeController::class, 'getShippingMethodsByCountry'])->name('getShippingMethodsByCountry');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost'])->name('login.post');

Route::middleware(['auth', 'checkUserIsAdmin'])->prefix('/admin')->name('admin.')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('product.create');
    Route::post('/products/create', [AdminController::class, 'createProductPost'])->name('product.create.post');
    Route::get('/products/edit/{id}', [AdminController::class, 'editProduct'])->name('product.edit');
    Route::post('/products/edit/{id}', [AdminController::class, 'editProductPost'])->name('product.edit.post');
    Route::get('/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('product.delete');

    Route::get('/countries', [AdminController::class, 'countries'])->name('countries');
    Route::get('/countries/create', [AdminController::class, 'createCountry'])->name('country.create');
    Route::post('/countries/create', [AdminController::class, 'createCountryPost'])->name('country.create.post');
    Route::get('/countries/edit/{id}', [AdminController::class, 'editCountry'])->name('country.edit');
    Route::post('/countries/edit/{id}', [AdminController::class, 'editCountryPost'])->name('country.edit.post');
    Route::get('/countries/delete/{id}', [AdminController::class, 'deleteCountry'])->name('country.delete');

    Route::get('/shipping-methods', [AdminController::class, 'shippingMethods'])->name('shippingMethods');
    Route::get('/shipping-methods/create', [AdminController::class, 'createShippingMethod'])->name('shippingMethod.create');
    Route::post('/shipping-methods/create', [AdminController::class, 'createShippingMethodPost'])->name('shippingMethod.create.post');
    Route::get('/shipping-methods/edit/{id}', [AdminController::class, 'editShippingMethod'])->name('shippingMethod.edit');
    Route::post('/shipping-methods/edit/{id}', [AdminController::class, 'editShippingMethodPost'])->name('shippingMethod.edit.post');
    Route::get('/shipping-methods/delete/{id}', [AdminController::class, 'deleteShippingMethod'])->name('shippingMethod.delete');

    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/export-to-xlsx', [AdminController::class, 'exportToXLSX'])->name('orders.export');
});
