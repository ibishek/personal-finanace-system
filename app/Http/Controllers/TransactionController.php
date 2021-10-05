<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Budget, Transaction, Category, PaymentOption};
use App\Http\Requests\TransactionCreateRequest;
use App\Services\{
    CacheRemember,
    CalculatePercentageForExpenseTransaction,
    TransactionService
};

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'DESC')
            ->with(['budget', 'category', 'paymentOption'])
            ->paginate(20);
        $modes = (new CacheRemember)->getCache('option');
        return view('transaction.index', compact('transactions', 'modes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $budget = Budget::select('id')->where('is_active', 1)->first();
        if ($budget) {
            $categories = Category::select(['id', 'title'])->get();
            $modes = PaymentOption::select(['id', 'title'])->get();

            return view('transaction.create', compact('categories', 'modes'));
        }

        return redirect('api/budgets/index')->with('error', 'Please create an active budget first.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionCreateRequest $request)
    {
        $validated = $request->validated();
        $resolve = (new TransactionService())->onSave($validated);
        // dd($resolve);
        if (!$resolve['status']) {
            return back()->with('error', $resolve['error'])->withInput();
        }

        return redirect('api/transactions/index')->with('success', $resolve['success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::with(['budget', 'category', 'paymentOption'])->findOrFail($id);

        $percent = (new CalculatePercentageForExpenseTransaction())
            ->percentage(
                $transaction->category_id,
                $transaction->amount,
                $transaction->budget_id
            );

        return view('transaction.show', compact('transaction', 'percent'));
    }
}
