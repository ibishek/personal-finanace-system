<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;

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

            return view('budget.current', compact('budget', 'remainingDays'));
        }

        return redirect('api/budgets/index')->with('error', 'There is no active budget found. Please create a new one.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
     * Check whether current budget is expired or not
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
