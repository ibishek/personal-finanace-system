<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BalanceController,
    BudgetController,
    CategoryController,
    PaymentModeController,
    ReminderController,
    TransactionController,
};

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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    Route::prefix('/api')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        //Balance Controller
        Route::get('balances/index', [BalanceController::class, 'index']);
        Route::get('balances/show/{id}', [BalanceController::class, 'show']);
        Route::get('balances/add-balance/{id}', [BalanceController::class, 'edit']);
        Route::put('balances/add-balance/{id}', [BalanceController::class, 'update']);

        //Budget Controller
        Route::get('budgets/index', [BudgetController::class, 'index']);
        Route::get('budgets/show/{id}', [BudgetController::class, 'show']);

        //Category Controller
        Route::get('categories/index', [CategoryController::class, 'index']);
        Route::get('categories/show/{id}', [CategoryController::class, 'show']);
        Route::get('categories/create', [CategoryController::class, 'create']);
        Route::post('categories/store', [CategoryController::class, 'store']);
        Route::get('categories/edit/{id}', [CategoryController::class, 'edit']);
        Route::put('categories/update/{id}', [CategoryController::class, 'update']);
        Route::delete('categories/delete/{id}', [CategoryController::class, 'destroy']);

        //PaymentMode Controller
        Route::get('payment-modes/index', [PaymentModeController::class, 'index']);
        Route::get('payment-modes/show/{id}', [PaymentModeController::class, 'show']);
        Route::get('payment-modes/create', [PaymentModeController::class, 'create']);
        Route::post('payment-modes/store', [PaymentModeController::class, 'store']);
        Route::get('payment-modes/edit/{id}', [PaymentModeController::class, 'edit']);
        Route::put('payment-modes/update/{id}', [PaymentModeController::class, 'update']);
        Route::delete('payment-modes/delete/{id}', [PaymentModeController::class, 'destroy']);

        //Reminder Controller

        //Transaction Controller
    });
});
