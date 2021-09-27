@extends('layouts.app')

@section('content')
<x-header title="All Balances Information" showCreate="false" link="" />
@include('layouts.session')
<div class="col-md-12">
    <canvas id="bar-index"></canvas>
</div>
<table class="table table-striped table-hover mt-4 p-2">
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Payment Mode</th>
            <th>Balance Amount</th>
            <th>option</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($balances as $balance)
        <tr>
            <td>{{ $loop->iteration }}</td>
            {{-- <td>{{ $balance->paymentMode>title }}</td> --}}
            {{-- <td>{{ $balance->getPaymentModeName($balance->mode_id) }}</td> --}}
            {{-- moethod below is still faster than comented method above, still both works though --}}
            <td>
                @foreach ($modes as $mode)
                @if ($balance->mode_id == $mode->id)
                {{ $mode->title }}
                @break;
                @endif
                @endforeach
            </td>
            <td class="format-amount" data-amount={{ $balance->amount }}></td>
            <td>
                <a href="{{ url('api/balances/show', $balance->id) }}" class="btn btn-show">Show</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">No record found</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection

@section('script')
<script src="{{ asset('js/accounting.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/balance.index.min.js') }}"></script>
@endsection