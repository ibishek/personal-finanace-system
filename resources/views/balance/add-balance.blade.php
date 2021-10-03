@extends('layouts.app')

@section('content')
<x-header title="Add Balance" showCreate="false" link="" />
@include('layouts.session')
<div class="card border-0 ml-2 mt-2">
    <div class="card-body">
        <form action="{{ url('api/balances/add-balance', $balance->id) }}" id="addAmountForm" class="form"
            method="POST">
            @csrf
            @method('put')
            <div>
                <strong>Payment Mode: </strong>{{ $balance->title }}
            </div>
            <div><strong>Current Balance: </strong>
                <span class="format-amount" data-amount="{{ $balance->balance }}"></span>
            </div>

            <div class="mt-2">
                <label for="condition">Condition</label>
                <select name="condition" id="condition"
                    class="form-control @error('condition') is-invalid @enderror rounded-0">
                    <option selected disabled>Select One</option>
                    <option value="{{ \Crypt::encrypt('incre'); }}">Deposit</option>
                    <option value="{{ \Crypt::encrypt('decre'); }}">Withdraw</option>
                </select>
                @error('condition')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mt-2">
                <label for="balance">Amount</label>
                <input type="text" class="form-control form-text rounded-0 @error('balance') is-invalid @enderror"
                    name="balance" id="balance" value="{{ old('balance') }}" data-mask="#,##0.00"
                    data-mask-reverse="true" />
                @error('balance')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <input type="submit" id="submitButton" value="..." class="btn btn-primary mt-2 cursor-none" />
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('vendor/js/accounting.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@endsection