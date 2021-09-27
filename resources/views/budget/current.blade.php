@extends('layouts.app')

@section('content')
<x-header title="Currently Active Budget" showCreate="false" link="" />
@include('layouts.session')
<div class="card border-0 mt-2">
    <div class="card-body">
        <div class="container">
            <h4><strong>{{ $budget->title }}</strong></h4>
            <div class="row mt-2">
                <div class="col-4">Alloted Amount: <span class="format-amount"
                        data-amount="{{ $budget->alloted_amount }}"></span></div>
                <div class="col-4">Savings: <span class="format-amount"
                        data-amount="{{ $budget->balance_amount }}"></span></div>
                <div class="col-4">Spending: <span class="format-amount"
                        data-amount="{{ $budget->alloted_amount - $budget->balance_amount }}"></span>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">Budget Commisioned: {{ $budget->created_at->format('Y-m-d l') }}</div>
                <div class="col-6">Budget will be expired: {{ $budget->expiry_date->format('Y-m-d l') }}</div>
            </div>
            <div class="row mt-2">
                <div class="col-4">Total Days:
                    {{ \Carbon\Carbon::parse($budget->created_at)->diffInDays($budget->expiry_date) + 2 }}
                </div>
                <div class="col-4">
                    @if ($remainingDays == 1)
                    Remaining Day:
                    @else
                    Remaining Days:
                    @endif
                    {{ $remainingDays }} <small>(Excluding Today)</small>
                    {{-- {{ \Carbon\Carbon::parse(now())->diffInDays($budget->expiry_date) }} --}}
                </div>
                <div class="col-4">Status:
                    @if ($budget->is_active == 1) Active
                    @elseif ($budget->is_active == 0) Depleted
                    @else ERROR: Contact for support
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/accounting.min.js') }}"></script>
@endsection