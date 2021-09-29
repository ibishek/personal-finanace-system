<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use DB;
use App\Models\{Balance, Budget, Category, PaymentMode, Transaction};

class AjaxDashboardController extends Controller
{
    private $__currentBudgetId;

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
        $budget = Budget::where('is_active', 1)->first();
        if ($budget) {
            return response()->json($budget, 200);
        }

        return response()->json([
            0 => [
                'title' => 'No active budget found. Please, a create new one.'
            ]
        ], 200);
    }

    /**
     * For first column in dashboard
     * Displays total income, total expense, total balance and cash on hand
     *
     * @return json
     */
    public function firstRow()
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
        $totalBalance = Balance::sum('amount');
        $cashOnHand = PaymentMode::select('id')
            ->first();
        $cashOnHandAmount = Balance::select('amount')
            ->where('mode_id', $cashOnHand->id)
            ->first();
        $resolve = [$totalIncome, $totalExpense, $totalBalance, $cashOnHandAmount->amount];

        return response()->json($resolve, 200);
    }

    /**
     * Dispalys current balances
     *
     * @return json
     */
    public function currentBalances()
    {
        $balances = DB::table('payment_modes')
            ->join('balances', 'payment_modes.id', '=', 'balances.mode_id')
            ->select(['payment_modes.title', 'balances.amount'])
            ->get();

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
        $amount = Budget::select('alloted_amount')
            ->where('id', $budgetId)
            ->get();

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

        $expenseTransaction = Transaction::select(['title', 'amount'])
            ->where('budget_id', $this->__currentBudgetId)
            ->WhereIn('category_id', $expenseIds)
            ->latest()
            ->take(10)
            ->get();

        return response()->json($expenseTransaction, 200);
    }
}
