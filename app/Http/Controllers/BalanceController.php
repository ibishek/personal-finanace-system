<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AddBalance;
use App\Models\PaymentOption;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balances = PaymentOption::select(['id', 'title', 'balance'])->get();

        return view('balance.index', compact('balances'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $balance = PaymentOption::findOrFail($id);

        return view('balance.show', compact('balance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $balance = PaymentOption::findOrFail($id);

        return view('balance.add-balance', compact('balance'));
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
        $request->validate([
            'balance' => 'required',
            'condition' => 'required'
        ]);

        $this->addBalance = new AddBalance();
        $resolve = $this->addBalance->saveBalance($request->balance, $request->condition, $id);

        if (!$resolve['status']) {
            return redirect()->back()->with('error', $resolve['error']);
        }

        return redirect('api/balances/index')->with('success', $resolve['success']);
    }
}
