@extends('layouts.app')

@section('content')
<x-header title="View Transaction" showCreate="true" link="api/transactions/create" />
<div class="card border-0 mt-2">
    <div class="card-body">
        <div class="col-12">
            <h2 class="text-right">
                <strong>{{ $transaction->budget->title }}</strong>
            </h2>
        </div>
        <div class="col-12 text-right">
            <small>{{ $transaction->created_at->format('Y-M-d, l') }}</small>
        </div>
        <div class="mt-4 mb-4">
            <hr />
        </div>

        <div class="col-12 text-center">
            <h4><strong>{{ $transaction->title }}</strong></h4>
        </div>
        <div class="@unless (empty($transaction->desc)) row @else @endunless">
            @unless (empty($transaction->desc))
            <div class="col-sm-6 text-right">
                {{ $transaction->desc }}
            </div>
            @endunless
            <div class="@unless (empty($transaction->desc)) col-sm-6 @else col-12 @endunless">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Type</th>
                            <th>Paid Via</td>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>{{ $transaction->category->title }}</td>
                            <td>{{ $transaction->paymentOption->title }}</td>
                            <td>
                                <span class="format-amount" data-amount="{{ $transaction->amount }}"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 text-right">
            <div><strong>Total Amount: </strong>
                <span class="format-amount" data-amount="{{ $transaction->amount }}"></span>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="col-2 text-center">
                {{ auth()->user()->name }}
                <hr />
                <h4>Thank You</h4>
            </div>
        </div>

    </div>
    @unless ($percent === null)
    <div class="card-footer bg-white">
        <div class="col-12">
            <h4>Summary:</h4>
            <div class="progress">
                <div class="progress-bar bg-danger" role="progressbar" style="{{ __("width: $percent%") }}"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            {{ __("You have spent $percent% of total budget amount in this transaction.") }}
        </div>
    </div>
    @endunless
</div>
@endsection

@section('script')
<script src="{{ asset('js/accounting.min.js') }}"></script>
@endsection