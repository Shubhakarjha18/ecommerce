<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminOrderController;

use App\Http\Controllers\CartController;
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

Route::get('/', [HomeController::class, 'home']);

Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [HomeController::class, 'login_home'])->name('dashboard');

    // Product Routes
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Cart Routes
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/place-order', [CartController::class, 'placeOrder'])->name('cart.placeOrder');

    // Orders Route
    Route::get('/orders', [CartController::class, 'view_orders'])->name('orders.index');
});


require __DIR__.'/auth.php';




Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
  

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/create', [ProductController::class, 'save'])->name('products.store');

Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Update the product
Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('products.update');

// Delete a product
Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('products.delete');
    
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');

// Update order status
Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});