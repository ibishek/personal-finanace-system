<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AddBalance;
use App\Models\Balance;
use App\Models\PaymentMode;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balances = Balance::with('paymentMode')->get();

        return view('balance.index', compact('balances'));
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
        $balance = Balance::with('paymentMode')->findOrFail($id);

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
        $balance = Balance::with('paymentMode')->findOrFail($id);

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
            'amount' => 'required',
            'condition' => 'required'
        ]);

        $this->addBalance = new AddBalance();
        $action = $this->addBalance->saveBalance($request->amount, $request->condition, $id);

        if (!$action['status']) {
            return redirect()->back()->with('error', $action['error']);
        }

        return redirect('api/balances/index')->with('success', 'Operaton completed successfully');
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
