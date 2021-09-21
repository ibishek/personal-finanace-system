@extends('layouts.app')

@section('content')
<x-header title="All Balances Information" showCreate="false" link="" />
@include('layouts.session')
<table class="table table-striped table-hover p-2">
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
            {{-- <td>{{ $balance->getPaymentModeName($balance->mode_id) }}</td> --}}
            {{-- moethod below is still faster than comented method above, still both works though --}}
            <td>
                @foreach ($modes as $mode)
                @if ($balance->mode_id == $mode->id)
                {{ $mode->title }}
                @endif
                @endforeach
            </td>
            <td id="correctAmount">{{ $balance->amount }}</td>
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

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $('#correctAmount').val().mask('#,##0.00');
</script>
@endsection