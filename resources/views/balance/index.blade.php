@extends('layouts.app')

@section('content')
<x-header title="All Balances Information" showCreate="false" link="" />
@include('layouts.session')
<div class="container-lg">
    <div class="row">
        <div class="col-xl-6 bg-white">
            <canvas id="bar-index"></canvas>
        </div>
        <div class="col-xl-6 bg-white">
            <table class="table table-index table-striped table-hover mt-sm-4 mt-xl-0">
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
                        <td>{{ $balance->title }}</td>
                        <td class="format-amount" data-amount={{ $balance->balance }}></td>
                        <td>
                            <a href="{{ url('api/balances/show', $balance->id) }}" class="btn btn-show">
                                <i class="fa fa-eye p-1"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No record found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/accounting.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/balance.index.min.js') }}"></script>
@endsection