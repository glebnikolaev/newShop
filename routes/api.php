<?php

use App\Http\Controllers\Api\V1\BannersController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\CategoriesController;
use App\Http\Controllers\Api\V1\ProductsController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\Modules\FeaturedController;
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
Route::prefix('v1')->name('api.')->group(function () {
    Route::get('banners', [BannersController::class, 'index']);
    Route::get('categories', [CategoriesController::class, 'index']);
    Route::get('products', [ProductsController::class, 'index']);

    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::post('register', [UserController::class, 'register'])->name('registers');
    Route::post('logout', [UserController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

    Route::prefix('modules')->group(function () {
        Route::get('featured', [FeaturedController::class, 'index']);
    });

    Route::prefix('cart')->group(function () {
        Route::post('add-to-cart', [CartController::class, 'addToCart']);
        Route::get('get-cart', [CartController::class, 'getCart']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
