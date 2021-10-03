@extends('layouts.app')

@section('content')
<x-header title="Create Payment Option" showCreate='false' link="" />
<div class="d-lg-flex">
    <div class="col-lg-8">
        <div class="card border-0 mt-2 ml-2">
            <div class="card-body">
                <form class="form" action="{{ url('api/payment-options/store') }}" autocomplete="off" method="POST">
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
                            class="form-control rounded-0 @error('desc') is-invalid @enderror"
                            value="{{ old('desc') }}" />
                        @error('desc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-primary mt-2" value="Create" />
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 mt-2 ml-2">
            <div class="card-body">
                <strong>Other Payment Options</strong>
                <ol class="p-2 show-gracefully" id="load-here"></ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){
        $.ajax({
            url: `${document.location.origin}/api/payment-options/index`,
            method: 'get',
            dataType: 'json',
            success: (data) => {
                data.map(item => {
                    $('ol#load-here').append(`<li class="p-2">${item.title}</li>`);
                });
                $('ol#load-here').addClass('is-ready');
            },
        });
    });
</script>
@endsection