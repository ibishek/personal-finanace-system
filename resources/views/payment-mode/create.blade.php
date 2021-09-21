@extends('layouts.app')

@section('content')
<x-header title="Create Payment Mode" showCreate='false' link="" />
<div class="card border-0 mt-2 ml-2">
    <div class="card-body">
        <form class="form" action="{{ url('api/payment-modes/store') }}" autocomplete="off" method="POST">
            @csrf
            <label for="title">Title</label>
            <input type="text" name="title" id="title"
                class="form-control rounded-0 @error('title') is-invalid @enderror" value="{{ old('title') }}"
                autofocus />

            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="mt-2">
                <label for="desc">Description</label>
                <input type="text" name="desc" id="desc"
                    class="form-control rounded-0 @error('desc') is-invalid @enderror" value="{{ old('desc') }}" />
                @error('desc')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <input type="submit" class="btn btn-edit mt-2" value="Create" />
        </form>
    </div>
</div>
@endsection