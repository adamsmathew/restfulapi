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



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::resource('buyers', BuyerController::class)->only(['index', 'show']);
Route::resource('categories', CategoryController::class)->only(['index', 'show']);
Route::resource('products', ProductController::class)->only(['index', 'show']);
// Route::resource('sellers', SellersController::class)->only(['index', 'show']);
Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
Route::resource('users', UserController::class)->only(['index', 'show']);
