@extends('layouts.app')

@section('content')
<x-header title="Show Balance" showCreate='false' link="" />
<div class="card border-0 mt-2">
    <div class="card-body ml-4">
        <div class="row">
            <strong>Payment Mode: </strong> {{ $balance->paymentMode->title }}
        </div>
        <div class="row">
            <strong>Balance: </strong> {{ $balance->amount }}
        </div>
    </div>
    <div class="card-footer bg-white row ml-4">
        <a href="{{ url('api/balances/add-balance',$balance->id) }}"
            class="btn btn-edit">{{ __('Deposit/Withdraw Amount') }}</a>
        <a href="{{ url()->previous() }}" class="btn btn-info ml-2">{{ __('Back with Reload') }}</a>
    </div>
</div>
@endsection