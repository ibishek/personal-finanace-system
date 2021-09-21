@extends('layouts.app')

@section('content')
<x-header title="Create Category" showCreate="false" link="" />
<div class="card border-0 mt-2 ml-2">
    <div class="card-body">
        <form action="{{ url('api/categories/store') }}" id="formCM" class="form" method="POST" autocomplete="off">
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
                <label for="entry">Entry Principle</label>
                <select name="entry" id="entry" class="form-control rounded-0 @error('entry') is-invalid @enderror">
                    <option selected disabled>Select One</option>
                    <option value="dr" @if(old('entry')=='dr' ) selected @endif>Debit</option>
                    <option value="cr" @if(old('entry')=='cr' ) selected @endif>Credit</option>
                </select>
                <small class="form-text text-muted text-info">Debit i.e. incoming amount. Credit i.e. outgoing
                    amount.</small>
                @error('entry')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
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