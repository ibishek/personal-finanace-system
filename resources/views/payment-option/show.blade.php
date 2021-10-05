@extends('layouts.app')

@section('content')
<x-header title="Show Payment Option" showCreate="true" link="api/payment-options/create" />
<div class="card border-0 mt-2">
    <div class="card-body ml-4">
        <div class="row">
            <strong class="col-md-2">{{ __('Title') }}</strong>{{ $paymentOption->title }}
        </div>
        <div class="row">
            <strong class="col-md-2">{{ __('Description') }}</strong>{{ $paymentOption->desc }}
        </div>
    </div>
    <div class="card-footer bg-white row ml-4">
        <a href="{{ url('api/payment-options/edit', $paymentOption->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
        @if ($paymentOption->is_deletable === 1)
        <form action="{{ url('api/payment-modes/delete', $paymentOption->id) }}" method="POST">
            @csrf
            @method('delete')
            <input type="submit" name="submit" value="Delete" class="btn btn-danger ml-2" />
        </form>
        @endif
    </div>
</div>
@endsection