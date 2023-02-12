<?php

use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
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

Route::get('product-category', [ProductCategoryController::class, 'index']);
Route::post('product-category', [ProductCategoryController::class, 'store']);
Route::put('product-category/{id}', [ProductCategoryController::class, 'update']);
Route::delete('product-category/{id}', [ProductCategoryController::class, 'destroy']);

Route::get('product', [ProductController::class, 'index']);
Route::post('product', [ProductController::class, 'store']);
Route::put('product/{id}', [ProductController::class, 'update']);
Route::delete('product/{id}', [ProductController::class, 'destroy']);
