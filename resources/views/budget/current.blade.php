@extends('layouts.app')

@section('content')
<x-header title="Currently Active Budget" showCreate="false" link="" />
@include('layouts.session')
<div class="row">
    <div class="col-md-6">
        <canvas id="current-budget"></canvas>
    </div>
    <div class="col-md-6">
        <h4><strong id="budget-title">{{ $budget->title }}</strong></h4>
        <hr />
        <div>
            <strong>Alloted Amount:</strong> <span class="format-amount"
                data-amount="{{ $budget->alloted_amount }}"></span>
        </div>
        <div>
            <strong>Spendings:</strong> <span id="spendings" class="format-amount"
                data-amount="{{ $budget->alloted_amount - $budget->balance_amount }}"></span>
        </div>
        <div>
            <strong>Savings:</strong> <span id="savings" class="format-amount"
                data-amount="{{ $budget->balance_amount }}"></span>
        </div>
        <div>
            <strong>Status:</strong>
            <span class="badge badge-primary border-0">Active</span>
        </div>
        <div>
            <strong>Out of commision at:</strong> {{ $budget->expiry_date->format('Y F d, l') }}
        </div>
        <div>
            <strong>Created At:</strong> {{ $budget->created_at->format('Y F d, l') }}
        </div>
        <span hidden
            id="total-days">{{ \Carbon\Carbon::parse($budget->created_at)->diffInDays($budget->expiry_date) + 2 }}
        </span>
        <span id="remaining-days" hidden>{{ $remainingDays }}</span>
        <div class="m-2">
            <canvas id="line-chart"></canvas>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card card-border-bottom custom-rounded mb-3">
                    <div class="card-body flex-column">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">{{ $totalTransactions }}</h5>
                            </div>
                        </div>
                        <div><i class="fa fa-list text-size text-1"></i></div>
                        @if ($totalTransactions === 1)
                        Transaction
                        @elseif ($totalTransactions === 0)
                        No transaction
                        @else
                        Total Transactions
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-border-bottom custom-rounded mb-3">
                    <div class="card-body flex-column">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">{{ $noOfIncomeTransactions }}</h5>
                            </div>
                        </div>
                        <div><i class="fa fa-cart-arrow-down text-size text-success"></i></div>
                        @if ($totalTransactions === 1)
                        Profitable Transaction
                        @elseif ($totalTransactions === 0)
                        No transaction
                        @else
                        Profitable Transactions
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-border-bottom custom-rounded mb-3">
                    <div class="card-body flex-column">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title">{{ $totalTransactions - $noOfIncomeTransactions }}</h4>
                            </div>
                        </div>
                        <div><i class="fa fa-cart-plus text-size text-danger"></i></div>
                        @if ($totalTransactions === 1)
                        Unprofitable Transaction
                        @elseif ($totalTransactions === 0)
                        No transaction
                        @else
                        Unprofitable Transactions
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/accounting.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/budget.current.min.js') }}"></script>
@endsection