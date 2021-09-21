@extends('layouts.app')

@section('content')
<x-header title="All Categories" showCreate="true" link="api/categories/create" />
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
        @forelse ($categories as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $category->title }}</td>
            <td class="row">
                <a href="{{ url('api/categories/show', $category->id) }}" class="btn btn-show m-1">Show</a>
                <a href="{{ url('api/categories/edit', $category->id) }}" class="btn btn-edit m-1">Edit</a>
                <form action="{{ url('api/categories/delete', $category->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger m-1">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">No Record found</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection