<?php

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
Route::group(['prefix' => '/v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'as' => 'api.'], function () {
    Route::get('banners', 'BannersController@index');
    Route::get('categories', 'CategoriesController@index');
    Route::get('products', 'ProductsController@index');

    Route::post('login', 'UserController@login')->name('login');
    Route::post('register', 'UserController@register')->name('registers');
    Route::post('logout', 'UserController@logout')->name('logout')->middleware('auth:sanctum');
});

Route::group(['prefix' => '/v1/modules', 'namespace' => 'App\Http\Controllers\Api\V1\Modules', 'as' => 'api.'], function () {
    Route::get('featured', 'FeaturedController@index');
});

Route::group(['prefix' => '/v1/cart', 'namespace' => 'App\Http\Controllers\Api\V1', 'as' => 'api.'], function () {
    Route::post('add-to-cart', 'CartController@addToCart');
    Route::get('get-cart', 'CartController@getCart');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
