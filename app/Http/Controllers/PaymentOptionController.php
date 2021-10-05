<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentOption;
use App\Services\{CacheRemember, PaymentOptionDelete};
use App\Http\Requests\PaymentOptionRequest;

class PaymentOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return PaymentOption::latest()
                ->take(10)
                ->get('title');
        }

        $paymentOptions = (new CacheRemember)->getCache('option');

        return view('payment-option.index', compact('paymentOptions'));
    }

    /**
     * Display the balance amount of request id
     *
     * @return \Illuminate\Http\Response
     */
    public function amount($id)
    {
        abort_unless(request()->ajax(), 403);
        $amount =  PaymentOption::where('id', $id)
            ->get('balance');

        return response()->json($amount, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment-option.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentOptionRequest $request)
    {
        $option = $request->validated();

        $option['balance'] = 00.00;
        $option['is_deletable'] = 1;
        PaymentOption::create($option);
        (new CacheRemember())->cacheOption();

        return redirect('api/payment-options/index')
            ->with('success', 'Payment option created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentOption = PaymentOption::findOrFail($id);

        return view('payment-option.show', compact('paymentOption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentOption = PaymentOption::findOrFail($id);

        return view('payment-option.edit', compact('paymentOption'));
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
        $getOption = $request->validated();

        $option = PaymentOption::findOrFail($id);
        $option->update($request->only(['title', 'desc']));

        (new CacheRemember())->cacheOption();
        return redirect('api/payment-options/index')
            ->with('success', 'Payment option updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->paymentOptionDelete = new PaymentOptionDelete();
        $resolve = $this->paymentOptionDelete->onDelete($id);

        if (!$resolve['status']) {
            return back()->with('error', $resolve["error"]);
        }
        (new CacheRemember)->cacheOption();
        return redirect('api/payment-options/index')->with('success', $resolve['success']);
    }
}
