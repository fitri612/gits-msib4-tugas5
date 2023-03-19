<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('category.update');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/products/{category_id}', [ProductController::class, 'getProducts']);
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');

Route::get('/transaction', [TransactionController::class, 'index'])->name('cart.index');
Route::post('/transaction', [TransactionController::class, 'addToCart'])->name('cart.addToCart');
Route::delete('/transaction/{cart}', [TransactionController::class, 'removeFromCart'])->name('cart.destroy');
Route::post('/transaction/checkout', [TransactionController::class, 'checkout'])->name('cart.checkout');
Route::get('/transaction/{cart}/edit', [TransactionController::class, 'editCart'])->name('cart.edit');
Route::put('/transaction/{cart}', [TransactionController::class, 'updateCart'])->name('cart.update');
