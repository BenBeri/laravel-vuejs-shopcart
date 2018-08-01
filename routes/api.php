<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/products", 'ProductsController@list')->name("api.products");

Route::get("/cart", 'CartController@list')->name("api.cart");
Route::put("/cart/add", 'CartController@add')->name("api.cart.add");
Route::delete("/cart/remove", 'CartController@remove')->name("api.cart.remove");