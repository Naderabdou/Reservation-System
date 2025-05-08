<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('localization')->namespace('API')->group(function () {

    // ===========================Auth routes=========================== //
    Route::post('login', 'UserController@login');
    // ===========================End Auth routes=========================== //




    Route::middleware(['auth:sanctum', 'checkRole:admin'])->group(function () {

        // ===========================Services routes=========================== //

        Route::get('services', 'ServiceController@index');

        // ===========================End Services routes=========================== //


        // ============================Orders routes Managing reservations =========================== //
        Route::get('orders', 'OrderController@index');
        Route::get('orders/cancel/{id}', 'OrderController@cancelOrder');
        Route::get('orders/show/{id}', 'OrderController@show');
        Route::post('change/order/status/{id}', 'OrderController@changeOrderStatus');

        // ===========================End My Orders routes=========================== //


        Route::post('logout', 'UserController@logout');
    });
});
