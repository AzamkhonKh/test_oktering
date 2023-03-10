<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/category', CategoryController::class);
Route::apiResource('/product', ProductController::class);
Route::get('/product/{id}/parameter', [ProductController::class, 'index_param']);
Route::post('/product/{id}/parameter', [ProductController::class, 'add_param']);
Route::get('cart', [OrderController::class, 'get_cart']);
Route::post('cart', [OrderController::class, 'add_cart']);
