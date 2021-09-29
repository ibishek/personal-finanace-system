<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AjaxDashboardController,
    BalanceController,
    BudgetController,
    CategoryController,
    CurrentBudgetController,
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

        //Ajax and Dashboard Controller
        Route::get('balances/current', [AjaxDashboardController::class, 'currentBalances']);
        Route::get('budgets/current/name', [AjaxDashboardController::class, 'getCurrentBudget']); // not found throw message
        Route::get('budgets/current/amount', [AjaxDashboardController::class, 'currentBudgetAmount']); // not found switch to latest
        Route::get('budgets/previous', [AjaxDashboardController::class, 'previousBudgets']);
        Route::get('dashboard/general-info', [AjaxDashboardController::class, 'firstRow']);
        Route::get('transactions/ten-income', [AjaxDashboardController::class, 'tenIncomes']);
        Route::get('transactions/ten-expense', [AjaxDashboardController::class, 'tenExpense']);

        //Balance Controller
        Route::get('balances/index', [BalanceController::class, 'index']);
        Route::get('balances/show/{id}', [BalanceController::class, 'show']);
        Route::get('balances/add-balance/{id}', [BalanceController::class, 'edit']);
        Route::put('balances/add-balance/{id}', [BalanceController::class, 'update']);

        //Budget and CurrentBudgetController Controller
        Route::get('budgets/index', [BudgetController::class, 'index']);
        Route::get('budgets/current', [CurrentBudgetController::class, 'index']);
        Route::get('budgets/show/{id}', [BudgetController::class, 'show']);
        Route::get('budgets/create', [BudgetController::class, 'create']);
        Route::post('budgets/store', [BudgetController::class, 'store']);

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
        Route::get('payment-modes/amount/{id}', [PaymentModeController::class, 'amount']);
        Route::delete('payment-modes/delete/{id}', [PaymentModeController::class, 'destroy']);

        //Reminder Controller

        //Transaction Controller
        Route::get('transactions/index', [TransactionController::class, 'index']);
        Route::get('transactions/show/{id}', [TransactionController::class, 'show']);
        Route::get('transactions/create', [TransactionController::class, 'create']);
        Route::post('transactions/store', [TransactionController::class, 'store']);
    });
});
