<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Budget, Transaction, Category, PaymentMode};
use App\Http\Requests\TransactionCreateRequest;
use App\Services\{CacheRemember, TransactionService};

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
            ->with(['budget', 'category', 'paymentMode'])
            ->paginate(20);
        $modes = (new CacheRemember)->getCache('mode');
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
            $modes = PaymentMode::select(['id', 'title'])->get();

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
        $action = (new TransactionService())->onSave($validated);
        // dd($action);
        if (!$action['status']) {
            return back()->with('error', $action['error'])->withInput();
        }

        return redirect('api/transactions/index')->with('success', $action['success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::with(['budget', 'category', 'paymentMode'])->findOrFail($id);

        return view('transaction.show', compact('transaction'));
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
}
