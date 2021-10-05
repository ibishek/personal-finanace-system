@extends('layouts.app')

@section('content')
<x-header title="Create Transaction" showCreate="false" link="" />
@include('layouts.session')
<div class="card border-0 mt-2 ml-2">
    <div class="card-body">
        <form action="{{ url('api/transactions/store') }}" method="POST" autocomplete="on" class="form">
            @csrf
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control rounded-0 @error('title') is-invalid @enderror"
                value="{{ old('title') }}" />
            @error('title')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
            <div class="mt-2">
                <label for="desc">Description</label>
                <input type="text" name="desc" class="form-control rounded-0 @error('desc') is-invalid @enderror"
                    value="{{ old('desc') }}" />
                @error('desc')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="row mt-2">
                <div class="col-lg-6">
                    <select name="mode" id="mode" class="form-control rounded-0 @error('mode') is-invalid @enderror">
                        <option selected disabled>Pay Via</option>
                        @forelse ($modes as $mode)
                        <option value="{{ $mode->id }}">{{ $mode->title }}</option>
                        @empty
                        <option>No record found</option>
                        @endforelse
                    </select>
                    @error('mode')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="col-lg-6 lg-mt-2">
                    <select name="category" id="category"
                        class="form-control rounded-0 @error('category') is-invalid @enderror">
                        <option selected disabled>Transaction category</option>
                        @forelse ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @empty
                        <option>No record found</option>
                        @endforelse
                    </select>
                    @error('category')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-6">
                    <span id="payVia"></span> <span id="payViaAmount"></span>
                </div>
                <div class="col-lg-6"></div>
            </div>
            <div class="mt-2">
                <label for="amount">Amount</label>
                <input type="text" name="amount" class="form-control rounded-0 @error('amount') is-invalid @enderror"
                    value="{{ old('amount') }}" data-mask="#,##0.00" data-mask-reverse="true" />
                @error('amount')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <input type="submit" class="mt-2 btn btn-primary" value="Start" />
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
        $('#mode').on("change", function() {
            let payVia = $('#mode option:selected').text();
            $('#payVia').text(`${payVia} :`);
            let payViaId = $('#mode option:selected').attr('value');
            const url = document.location.origin;
            $.ajax({
                url: `${url}/api/payment-options/amount/${payViaId}`,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    $('#payViaAmount').text(data[0].balance);
                }
            });
        });
    });
</script>
@endsection