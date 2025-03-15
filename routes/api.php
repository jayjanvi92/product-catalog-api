<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController as ProductControllerV1;
use App\Http\Controllers\Api\V1\CategoryController as CategoryControllerV1;
use App\Http\Controllers\Api\V2\ProductController as ProductControllerV2;

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

Route::prefix('V1')->group(function () {
    Route::apiResource('products', ProductControllerV1::class);
    Route::apiResource('categories', CategoryControllerV1::class)->only(['index', 'store']);
});

Route::prefix('V2')->group(function () {
    Route::get('products', [ProductControllerV2::class, 'index']);
});