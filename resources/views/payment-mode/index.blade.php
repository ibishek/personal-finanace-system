@extends('layouts.app')

@section('content')
<x-header title="All Payment Modes" showCreate="true" link="api/payment-modes/create" />
@include('layouts.session')
<table class="table table-striped table-hover mt-2 ml-2">
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($paymentModes as $mode)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $mode->title }}</td>
            <td class="row">
                <a href="{{ url('api/payment-modes/show', $mode->id) }}" class="btn btn-show m-1">Show</a>
                <a href="{{ url('api/payment-modes/edit', $mode->id) }}" class="btn btn-edit m-1">Edit</a>
                @if ($mode->is_deletable === 1)
                <form action="{{ url('api/payment-modes/delete', $mode->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" name="delete" id="" value="Delete" class="btn btn-danger m-1" />
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">No Record Found</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection