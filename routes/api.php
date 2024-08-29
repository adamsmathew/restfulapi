<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Buyer\BuyerController;  
use App\Http\Controllers\Buyer\BuyerProductController;
use App\Http\Controllers\Buyer\BuyerTransactionController;
use App\Http\Controllers\Buyer\BuyerSellerController;
use App\Http\Controllers\Buyer\BuyerCategoryController;  

use App\Http\Controllers\Category\CategoryController;   
use App\Http\Controllers\Category\CategoryProductController;   
use App\Http\Controllers\Category\CategorySellerController;
use App\Http\Controllers\Category\CategoryTransactionController;
use App\Http\Controllers\Category\CategoryBuyerController;


use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductTransactionController;
use App\Http\Controllers\Product\ProductBuyerController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductBuyerTransactionController;


use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerTransactionController;
use App\Http\Controllers\Seller\SellercategoryController;
use App\Http\Controllers\Seller\SellerBuyerController;
use App\Http\Controllers\Seller\SellerProductController;


use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Transaction\TransactionCategoryController;
use App\Http\Controllers\Transaction\TransactionSellerController;

use App\Http\Controllers\User\UserController;

// Define routes for buyers
Route::resource('buyers', BuyerController::class);
Route::resource('buyers.transactions', BuyerTransactionController::class);
Route::resource('buyers.products', BuyerProductController::class);
Route::resource('buyers.sellers', BuyerSellerController::class);
Route::resource('buyers.categories', BuyerCategoryController::class);


// Define routes for categories  
Route::resource('categories', CategoryController::class);
Route::resource('categories.products', CategoryProductController::class);
Route::resource('categories.sellers', CategorySellerController::class);
Route::resource('categories.transactions', CategoryTransactionController::class);
Route::resource('categories.buyers', CategoryBuyerController::class);


// Define routes for products 

Route::resource('products', ProductController::class);
Route::resource('products.transactions', ProductTransactionController::class);
Route::resource('products.buyers', ProductBuyerController::class);
Route::resource('products.categories', ProductCategoryController::class);
Route::resource('products.buyers.transactions', ProductBuyerTransactionController::class);

// Define routes for sellers
Route::resource('sellers', SellerController::class);
Route::resource('sellers.transactions', SellerTransactionController::class);
Route::resource('sellers.categories', SellerCategoryController::class);
Route::resource('sellers.buyers', SellerBuyerController::class);
Route::resource('sellers.products', SellerProductController::class);


// Define routes for transactions  
Route::resource('transactions', TransactionController::class);
Route::resource('transactions.categories', TransactionCategoryController::class);
Route::resource('transactions.sellers', TransactionSellerController::class);


// Define routes for users
Route::resource('users', UserController::class);

