@extends('layouts.app')

@section('content')
<x-header title="Show Category" showCreate='true' link="api/categories/create" />
<div class="card border-0 mt-2">
    <div class="card-body ml-4">
        <div class="row">
            <strong class="col-md-2">Title:</strong> {{ $category->title }}
        </div>
        <div class="row">
            <strong class="col-md-2">Entry Principle:</strong>
            @if($category->entry == 'dr')
            {{ __('Debit') }}
            @elseif ($category->entry == 'cr')
            {{ __('Credit') }}
            @else
            <span class="text-danger">{{ __('Contact for developer support immediately') }}</span>
            @endif
        </div>
        <div class="row">
            <strong class="col-md-2">Description:</strong> {{ $category->desc }}
        </div>
    </div>
    <div class="card-footer bg-white row ml-4">
        <a href="{{ url('api/categories/edit',$category->id) }}" class="btn btn-edit">{{ __('Edit') }}</a>
        <form action="{{ url('api/categories/delete', $category->id) }}" method="POST">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger ml-2" />
        </form>
        <a href="{{ url()->previous() }}" class="btn btn-info ml-2">{{ __('Back with Reload') }}</a>
    </div>
</div>
@endsection