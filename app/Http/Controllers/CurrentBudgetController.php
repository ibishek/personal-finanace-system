<?php

namespace App\Http\Controllers;

use App\Models\{Budget, Category, Transaction};

class CurrentBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budget = Budget::where('is_active', 1)->first();
        if ($budget) {
            // We must include last date as well
            $remainingDays = $this->remainingDays($budget->expiry_date) + 1;
            $totalTransactions = Transaction::where('budget_id', $budget->id)->count();
            $categoriesId = Category::getAllIdHavingDebitEntry();
            $noOfIncomeTransactions = 0;
            foreach ($categoriesId as $cId) {
                $noOfIncomeTransactions += Transaction::where([
                    'budget_id' => $budget->id,
                    'category_id' => $cId->id
                ])->count();
            }

            return view('budget.current', compact('budget', 'remainingDays', 'totalTransactions', 'noOfIncomeTransactions'));
        }

        return redirect('api/budgets/index')->with('error', 'There is no active budget found. Please create a new one.');
    }

    /**
     * Returns the absolute difference between 2 dates.
     * ex. 10 - 5 = 4
     *
     * @param  date $budget->expiry_date
     * @return int day(s)
     */
    public static function remainingDays($expiryDate)
    {
        return \Carbon\Carbon::parse(now())->diffInDays($expiryDate);
    }

    /**
     * Check whether current budget is expired or not at login time
     * 
     * @return null
     */
    public function whetherBudgetIsExpired()
    {
        $budget = Budget::where('is_active', 1)->first();   // null or value
        if ($budget) {
            $remainingDays = $this->remainingDays($budget->expiry_date);
            if ($remainingDays == 0) {
                $today = \Carbon\Carbon::parse(now());
                $isSameDay = $today->isSameDay($budget->expiry_date); // true or false
                if (!$isSameDay) {
                    $budget->update([
                        'is_active' => 0
                    ]);
                }
            }
        }
    }
}
