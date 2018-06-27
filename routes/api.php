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
Route::get('products','ProductsController@index');
Route::post('login','UsersController@login');
Route::post('register','UsersController@register');
Route::post('update','UsersController@updateUser');
Route::post('order_product','OrdersController@createOrder');
Route::post('delete_order','OrdersController@delete');
Route::post('orders','OrdersController@showOrders');