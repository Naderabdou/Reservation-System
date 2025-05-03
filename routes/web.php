<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\CeckController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\OrderController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Site\ServiceController;



Route::namespace('Site')->name('site.')->middleware('lang')->group(function () {


    // -------------------------------- Home Page Routes --------------------------------//
    Route::get('/', [HomeController::class, 'index'])->name('home');


    Route::get('services', [ServiceController::class, 'index'])->name('services');
    Route::get('services/show/{slug}', [ServiceController::class, 'show'])->name('services.show');


    Route::get('/lang/{lang}', [HomeController::class, 'lang'])->name('lang');

    //-------------------------------- End Home Page Routes ------------------------------//






    ////////////////////////////// auth routes //////////////////////////////
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'getLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:5,1');

        Route::post('register', [AuthController::class, 'register'])->name('register.post');
        Route::get('register', [AuthController::class, 'getRegister'])->name('register');
    });
    ////////////////////////////// auth routes //////////////////////////////



    //////////////////////////////////// user routes //////////////////////////////
    Route::middleware('auth')->group(function () {


        // ---------------------------------- user profile pages actions -------------------------------//
        Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
        Route::post('userUpdate', [ProfileController::class, 'UserUpdate'])->name('user.update');
        Route::post('userResetPassword', [ProfileController::class, 'ResetPassword'])->name('user.resetpassword');
        Route::get('logout', [ProfileController::class, 'logout'])->name('logout');


        Route::get('myorders', [OrderController::class, 'index'])->name('myorders');
        Route::post('service/order/store', [OrderController::class, 'store'])->name('services.store');
        Route::get('orderdetails/{order}', [OrderController::class, 'show'])->name('order.show');
        Route::get('cancelorder/{order}', [OrderController::class, 'cancel'])->name('order.cancel');

        // ---------------------------------- user profile pages actions -------------------------------//

    });
    //////////////////////////////////// user routes //////////////////////////////




    // ---------------------------------- check routes -------------------------------//
    Route::post('check-email', [CeckController::class, 'email'])->name('check.email');
    Route::post('check-email-dns', [CeckController::class, 'CheckemailDns'])->name('check.email.dns');
    Route::post('check-phone', [CeckController::class, 'phone'])->name('check.phone');
    Route::post('check-password', [CeckController::class, 'password'])->name('check.password');
    Route::post('check-date', [CeckController::class, 'CheckDate'])->name('check.date');
    // ---------------------------------- check routes -------------------------------//

});
