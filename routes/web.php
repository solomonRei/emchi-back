<?php

use App\Http\API\UserController;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Auth\CustomLoginController;
use \App\Http\Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('profile.index');
});

Route::get('endpoint',[UserController::class, 'getAppointments']);

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
        });
});

});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
