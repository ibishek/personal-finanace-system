<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AddBalance;
// use Illuminate\Support\Facades\Crypt;
// use Illuminate\Contracts\Encryption\DecryptException;
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
        $balances = Balance::all();
        $modes = PaymentMode::all();

        return view('balance.index', compact('balances', 'modes'));
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
        $balance = Balance::findOrFail($id);

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
        $balance = Balance::findOrFail($id);

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
        $success = $this->addBalance->saveBalance($request->amount, $request->condition, $id);

        if (!$success) {
            return redirect()->back()->with('add-balance-error', 'Error while operation');
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
