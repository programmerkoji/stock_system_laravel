<?php

use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('product-category', [ProductCategoryController::class, 'index']);
// Route::post('product-category', [ProductCategoryController::class, 'store']);
// Route::put('product-category/{id}', [ProductCategoryController::class, 'update']);
// Route::delete('product-category/{id}', [ProductCategoryController::class, 'destroy']);

Route::apiResource('product-category', ProductCategoryController::class)
    ->except('show');

Route::apiResource('product', ProductController::class)
    ->except('show');

Route::get('stock/{product_id}', [StockController::class, 'index']);
