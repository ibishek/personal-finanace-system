@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
@endsection

@section('content')
<x-header title="Create a new Budget" showCreate="false" link="" />
<div class="card bg-white border-0 mt-2">
    <div class="card-body">
        <form action="{{ url('api/budgets/store') }}" class="form" method="POST">
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
            <div class="mt-2">
                <label for="alloted_amount">Allot Amount</label>
                <input type="text" name="alloted_amount"
                    class="form-control rounded-0 @error('alloted_amount') is-invalid @enderror"
                    value="{{ old('alloted_amount') }}" data-mask="#,##0.00" data-mask-reverse="true" />
                @error('alloted_amount')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mt-2">
                <label for="expiry_date">Budeget Expires After</label>
                <input type="text" name="expiry_date"
                    class="form-control rounded-0 @error('expiry_date') is-invalid @enderror"
                    value="{{ old('expiry_date') }}" id="expiry_date" />
                @error('expiry_date')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <input type="submit" class="btn btn-edit mt-2" value="Create" />
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        $('#expiry_date').datepicker({
            minDate: 6,
            dateFormat: "yy-mm-dd"
        });
    });
</script>
@endsection