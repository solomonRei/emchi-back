<?php

use App\Http\API\UserController;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Auth\CustomLoginController;
use \App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('profile.index');
});

Route::get('404', function () {
    return view('layouts.404');
})->name('404');

Route::get('get-users', [UserController::class, 'getUsers2']);

Route::middleware('profile')->group(function () {
    Route::get('login', [CustomLoginController::class, 'index'])->name('login');
    Route::get('make-appointment', [CustomLoginController::class, 'index'])->name('login');
    Route::post('profile-login', [CustomLoginController::class, 'login'])->name('login.post');
    Route::post('logout', [CustomLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function() {
        Route::controller(ProfileController::class)
            ->prefix('user')
            ->name('profile.')
            ->group(function () {
    //            user/{action}
                Route::get('profile', 'profile')->name('index');
                Route::get('payments', 'payments')->name('payment');
                Route::get('analyzes', 'analyzes')->name('analyzes');
                Route::get('appointments', 'records')->name('records');
                Route::get('services', 'services')->name('services');
                Route::get('downloadPDF/{id}', 'getPDF')->name('get-pdf');
                Route::get('downloadFile/{filename}', 'downloadFile')->name('download-file');
            });
    });
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
