@extends('layouts.app')

@section('content')
<x-header title="Dashboard" showCreate="false" link="" />
<div class="row m-2">
    <div class="col-md-12 mb-2">
        <small class="float-right" id="budget-title">Current Budget <code>i.e.</code></small>
    </div>
    <div class="col-md-3">
        <div class="card rounded-0 text-white bg-success mb-3">
            <div class="card-header">Total Income</div>
            <div class="card-body flex-column">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title" id="total-income"></h5>
                    </div>
                    <div class="col-auto ps-0">
                        <img src="{{ asset('icons/credit-card.svg') }}" alt="proftable transaction" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card rounded-0 text-white bg-danger mb-3">
            <div class="card-header">Total Expenses</div>
            <div class="card-body flex-column">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title for" id="total-expense"></h5>
                    </div>
                    <div class="col-auto ps-0">
                        <img src="{{ asset('icons/credit-card.svg') }}" alt="proftable transaction" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card rounded-0 text-white bg-primary mb-3">
            <div class="card-header">Total Balance</div>
            <div class="card-body flex-column">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title" id="total-balance"></h5>
                    </div>
                    <div class="col-auto ps-0">
                        <img src="{{ asset('icons/credit-card.svg') }}" alt="proftable transaction" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card rounded-0 text-white bg-info mb-3">
            <div class="card-header">Cash on Hand</div>
            <div class="card-body flex-column">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title" id="cash-on-hand"></h5>
                    </div>
                    <div class="col-auto ps-0">
                        <img src="{{ asset('icons/credit-card.svg') }}" alt="proftable transaction" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row m-2">
    <div class="col-lg-6">
        <div class="card border-0">
            <div class="card-header p-0 bg-white">Current Balances</div>
            <div class="card-body">
                <canvas id="current-balances"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card border-0">
            <div class="card-header p-0 bg-white">% of Budgets Income</div>
            <div class="card-body">
                <canvas id="percent-of-income"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card border-0">
            <div class="card-header p-0 bg-white">% of Budgets Expense</div>
            <div class="card-body">
                <canvas id="percent-of-expense"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row m-2">
    <div class="col-lg-6">
        <div class="card border-0">
            <div class="card-header p-0 bg-white">Previous Budgets</div>
            <div class="card-body p-0">
                <canvas id="previus-budgets"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">

    </div>
</div>

<div class="row m-2">
    <div class="col-lg-6">
        <div class="card border-0">
            <div class="card-header p-0 bg-white">Latest Income Transactions</div>
            <div class="card-body p-0">
                <table id="income" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Title</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0">
            <div class="card-header p-0 bg-white">Latest Expense Transactions</div>
            <div class="card-body p-0">
                <table id="expense" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Title</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
<script src="{{ asset('js/accounting.min.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection