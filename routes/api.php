<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\User\UserController;

// Define routes for buyers
Route::resource('buyers', BuyerController::class);


// Define routes for categories
Route::resource('categories', CategoryController::class)->except(['create', 'edit']);


// Define routes for products
Route::resource('products', ProductController::class)->only(['index', 'show']);

 
// Define routes for sellers
Route::resource('sellers', SellerController::class)->only(['index', 'show']);
// Route::get('sellers', [SellerController::class, 'index']);


// Define routes for transactions
Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
// Route::get('transactions', [BuyerController::class, 'index']);

// Define routes for users
Route::resource('users', UserController::class);
