@extends('layouts.app')

@section('content')
<x-header title="View Budget" showCreate="true" link="api/budegts/create" />
<div class="row">
    <div class="col-md-6">
        <canvas id="budget"></canvas>
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
            <strong>Out of commision at:</strong> {{ $budget->expiry_date->format('Y F d, l') }}
        </div>
        <div>
            <strong>Created At:</strong> {{ $budget->created_at->format('Y F d, l') }}
        </div>
        <div class="row mt-4">
            <div class="col-sm-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Transactions</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalTransactions }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Income Transactions</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $incomeTransactions }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Expense Transactions</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalTransactions - $incomeTransactions }}</h5>
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
<script src="{{ asset('js/budget.show.min.js') }}"></script>
@endsection