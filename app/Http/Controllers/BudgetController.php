<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Budget, Category, Transaction};
use App\Http\Requests\BudgetCreateRequest;
use App\Services\{CacheRemember, UnmaskAmount};

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets = Budget::latest()->paginate(20);

        return view('budget.index', compact('budgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $budget = Budget::where('is_active', 1)->count();
        if ($budget === 1) {
            return redirect('api/budgets/current')->with('error', 'There is an active budget found. So, you can not create another budget.');
        }

        return view('budget.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetCreateRequest $request)
    {
        $validated = $request->validated();
        $validated['alloted_amount'] = UnmaskAmount::unmask($validated['alloted_amount']);
        $validated['balance_amount'] = $validated['alloted_amount'];
        $validated['is_active'] = 1;
        Budget::create($validated);

        (new CacheRemember())->cacheBudget();
        return redirect('api/budgets/index')->with('success', 'Budget successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $budget = Budget::findOrFail($id);
        $totalTransactions = Transaction::where('budget_id', $budget->id)->count();
        $categoriesId = Category::getAllIdHavingDebitEntry();
        $noOfIncomeTransactions = 0;
        foreach ($categoriesId as $cId) {
            $noOfIncomeTransactions += Transaction::where([
                'budget_id' => $id,
                'category_id' => $cId->id
            ])->count();
        }

        return view('budget.show', compact('budget', 'totalTransactions', 'noOfIncomeTransactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // end budget term is coming soon
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
        // end budget term is coming soon
    }
}
