<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Balance, PaymentMode};
use App\Services\{CacheRemember, PaymentModeDelete};
use DB;

class PaymentModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $paymentModes = PaymentMode::all();
        $paymentModes = (new CacheRemember)->getCache('mode');

        return view('payment-mode.index', compact('paymentModes'));
    }

    /**
     * Ajax Method
     * 
     * Return the amount from id
     *
     * @param int $id
     * @return float amount
     */
    public function amount($id)
    {
        $amount = Balance::select('amount')->where('mode_id', $id)->first();

        return response()->json($amount, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment-mode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'desc' => ['string', 'nullable']
        ]);

        try {
            DB::beginTransaction();
            PaymentMode::create($request->all());

            $getModeId = PaymentMode::select('id')->where('title', $request->title)->get();
            Balance::create([
                'mode_id' => $getModeId[0]->id,
                'amount' => 00.00
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('api/payment-modes/index')->with('error', 'ERROR: While creating payment mode');
        }

        (new CacheRemember())->cacheMode();
        return redirect('api/payment-modes/index')->with('success', 'Payment mode is created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mode = PaymentMode::findOrFail($id);

        return view('payment-mode.show', compact('mode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mode = PaymentMode::findOrFail($id);

        return view('payment-mode.edit', compact('mode'));
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
            'title' => ['required', 'string'],
            'desc' => ['string', 'nullable']
        ]);
        $mode = PaymentMode::findOrFail($id);
        $mode->update($request->all());

        (new CacheRemember())->cacheMode();
        return redirect('api/payment-modes/index')->with('success', 'Payment mode is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->paymentModeDelete = new PaymentModeDelete();
        $action = $this->paymentModeDelete->onDelete($id);

        if (!$action['status']) {
            return redirect('api/payment-modes/index')
                ->with('error', "ERROR: {$action['error']}");
        }

        try {
            DB::beginTransaction();

            $balance = Balance::where('mode_id', $id)->get();
            if (count($balance) > 0) {
                // closure serialization problem arised
                DB::table('balances')->where('mode_id', $id)->delete();
            }

            $paymentMode = PaymentMode::findOrFail($id);
            $paymentMode->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return redirect('api/payment-modes/index')->with('error', "ERROR: {$e}");
        }
        (new CacheRemember())->cacheMode();
        return redirect('api/payment-modes/index')->with('success', 'Payment mode is deleted succcessfully');
    }
}
