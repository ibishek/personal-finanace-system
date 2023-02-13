<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::get('login', function () {
        return view('app');
    })->name('login');
    Route::post('login', [AuthController::class, 'login']);


    Route::get('/{any}', function () {
        return view('app');
    })->where('any', '(.*)');
});
