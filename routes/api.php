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
    Route::post('logout', 'UserController@logout')->middleware('auth:sanctum');
    // ===========================End Auth routes=========================== //


    // ===========================Services routes=========================== //
    // ===========================End Services routes=========================== //


    Route::middleware(['auth:sanctum', 'checkRole:admin'])->group(function () {

        Route::get('services', 'ServiceController@index');



        // ============================Orders routes Managing reservations =========================== //
        Route::get('orders', 'OrderController@index');
        Route::get('orders/cancel/{id}', 'OrderController@cancelOrder');
        Route::get('orders/show/{id}', 'OrderController@show');
        Route::post('change/order/status/{id}', 'OrderController@changeOrderStatus');

        // ===========================End My Orders routes=========================== //




    });
});
