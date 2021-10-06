<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use DB;
use App\Models\{Balance, Budget, Category, PaymentOption, Transaction};

class AjaxDashboardController extends Controller
{
    /**
     * Reject any request other than ajax
     */
    public function __construct()
    {
        // abort_unless(request()->ajax(), 403);
    }

    /**
     * Display the title of currently active budget
     *
     * @return json
     */
    public function getCurrentBudget()
    {
        $budgetTitle = Budget::where('is_active', 1)->first('title');
        if ($budgetTitle) {
            return response()->json($budgetTitle, 200);
        }

        return response()->json([
            0 => [
                'title' => 'No active budget found. Please, create a new one.'
            ]
        ], 200);
    }

    /**
     * For first column in dashboard
     * Displays total income, total expense, total balance and cash on hand
     *
     * @return json
     */
    public function generalInfo()
    {
        $this->__currentBudgetId = Budget::getCurrentBudgetId();
        $incomeIds = Category::getAllIdHavingDebitEntry();
        $expenseIds = Category::getAllIdHavingCreditEntry();

        $totalIncome = Transaction::where('budget_id', $this->__currentBudgetId)
            ->whereIn('category_id', $incomeIds)
            ->sum('amount');

        $totalExpense = Transaction::where('budget_id', $this->__currentBudgetId)
            ->whereIn('category_id', $expenseIds)
            ->sum('amount');

        $totalBalance = PaymentOption::sum('balance');

        $cashOnHandAmount = PaymentOption::first('balance');

        return response()->json([
            $totalIncome, $totalExpense, $totalBalance, $cashOnHandAmount
        ], 200);
    }

    /**
     * Dispalys current balances
     *
     * @return json
     */
    public function currentBalances()
    {
        $balances = PaymentOption::get(['title', 'balance']);

        return response()->json($balances, 200);
    }

    /**
     * Return alloted amount of current budget
     * if not found switch to latest
     *
     * @return json
     */
    public function currentBudgetAmount()
    {
        $budgetId = Budget::getCurrentBudgetId();
        $amount = Budget::where('id', $budgetId)
            ->get('alloted_amount');

        return response()->json($amount, 200);
    }

    /**
     * Display latest five budgets 
     *
     * @return json
     */
    public function previousBudgets()
    {
        $budgets = Budget::select(['title', 'alloted_amount', 'balance_amount'])
            ->latest()
            ->take(5)
            ->get();

        return response()->json($budgets, 200);
    }

    /**
     * Dispaly 10 latest income transactions
     *
     * @return json
     */
    public function tenIncomes()
    {
        $this->__currentBudgetId = Budget::getCurrentBudgetId();
        $incomeIds = Category::getAllIdHavingDebitEntry();

        $incomeTransaction = Transaction::select(['title', 'amount'])
            ->where('budget_id', $this->__currentBudgetId)
            ->WhereIn('category_id', $incomeIds)
            ->latest()
            ->take(10)
            ->get();

        return response()->json($incomeTransaction, 200);
    }

    /**
     * Dispaly 10 latest expense transactions
     *
     * @return void
     */
    public function tenExpense()
    {
        $this->__currentBudgetId = Budget::getCurrentBudgetId();
        $expenseIds = Category::getAllIdHavingCreditEntry();
        // if (!$this->__currentBudgetId) {

        // }

        $expenseTransaction = Transaction::select(['title', 'amount'])
            ->where('budget_id', $this->__currentBudgetId)
            ->WhereIn('category_id', $expenseIds)
            ->latest()
            ->take(10)
            ->get();

        return response()->json($expenseTransaction, 200);
    }
}
