@extends('layouts.app')

@section('content')
<x-header title="Show Payment Mode" showCreate="true" link="api/payment-modes/create" />
<div class="card border-0 mt-2">
    <div class="card-body ml-4">
        <div class="row">
            <strong class="col-md-2">{{ __('Title') }}</strong>{{ $mode->title }}
        </div>
        <div class="row">
            <strong class="col-md-2">{{ __('Description') }}</strong>{{ $mode->desc }}
        </div>
    </div>
    <div class="card-footer bg-white row ml-4">
        <a href="{{ url('api/payment-modes/edit', $mode->id) }}" class="btn btn-edit">{{ __('Edit') }}</a>
        @if ($mode->is_deletable === 1)
        <form action="{{ url('api/payment-modes/delete', $mode->id) }}" method="POST">
            @csrf
            @method('delete')
            <input type="submit" name="submit" value="Delete" class="btn btn-danger ml-2" />
        </form>
        @endif
        <a href="{{ url()->previous() }}" class="btn btn-info ml-2">{{ __('Back with Reload') }}</a>
    </div>
</div>
@endsection