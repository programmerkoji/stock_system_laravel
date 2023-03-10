<?php

use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\api\AuthController;
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

Route::group(
    ['middleware' => 'auth:api'],
    function () {
        Route::apiResource('user', UserController::class)
            ->except('show');
        Route::apiResource('product-category', ProductCategoryController::class)
            ->except('show');

        Route::apiResource('product', ProductController::class)
            ->except('show');

        Route::prefix('stock')->group(function () {
            Route::get('/total/{product_id}', [StockController::class, 'total']);
            Route::get('/summary/{product_category_id}', [StockController::class, 'summary']);
            Route::get('/summary/product/{product_id}', [StockController::class, 'summaryByProduct']);
            Route::get('/{product_id}', [StockController::class, 'index']);
            Route::post('/', [StockController::class, 'store']);
            Route::put('/{id}/edit', [StockController::class, 'update']);
            Route::delete('/{id}', [StockController::class, 'destroy']);
        });
    }
);
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout']);
