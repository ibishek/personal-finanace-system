@extends('layouts.app')

@section('content')
<x-header title="View Transaction" showCreate="true" link="api/transactions/create" />
<div class="card border-0 mt-2">
    <div class="card-body">
        <h4>
            <strong>{{ $transaction->title }}</strong>
        </h4>
        <div class="mt-2">
            <strong>Description:</strong> {{ $transaction->desc }}
        </div>
        <div class="mt-2">
            <strong>Budget:</strong> {{ $transaction->budget->title }}
        </div>
        <div class="mt-2">
            <strong>Paid Via:</strong> {{ $transaction->paymentMode->title }}
        </div>
        <div class="mt-2">
            <strong>Transaction Category:</strong> {{ $transaction->category->title }}
        </div>
        <div class="mt-2">
            <strong>Transaction Amount:</strong>
            <span class="format-amount" data-amount="{{ $transaction->amount }}"></span>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/accounting.min.js') }}"></script>
@endsection