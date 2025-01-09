<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\CheckRegistrationFee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::middleware(['auth',CheckRegistrationFee::class])->group(function () {
    Route::get('/', [HomeController::class, 'search'])->name('home');
    
    Route::get('/room', function () {
        return view('room');
    })->name('room');

    Route::get('/payment', function(){
        return view('payment');
    })->name('payment');

    Route::post('/topup', [PaymentController::class, 'topup'])->name('topup');
    
    Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');

    Route::post('/user/visible', [HomeController::class, 'visible'])->name('user.visible');

    Route::post('/user/like/{user}', [HomeController::class, 'like'])->name('user.like');
});


