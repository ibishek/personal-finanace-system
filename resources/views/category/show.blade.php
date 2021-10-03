@extends('layouts.app')

@section('content')
<x-header title="Show Category" showCreate='true' link="api/categories/create" />
<div class="card border-0 mt-2">
    <div class="card-body ml-4">
        <div>
            <strong>Title:</strong> {{ $category->title }}
        </div>
        <div>
            <strong>Entry Principle:</strong>
            @if($category->entry == 'dr')
            {{ __('Debit') }}
            @elseif ($category->entry == 'cr')
            {{ __('Credit') }}
            @else
            <span class="text-danger">{{ __('Contact for developer support immediately') }}</span>
            @endif
        </div>
        <div>
            <strong>Description:</strong> {{ $category->desc }}
        </div>
    </div>
    <div class="card-footer bg-white row ml-4">
        <a href="{{ url('api/categories/edit',$category->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
        @if ($category->is_deletable === 1)
        <form action="{{ url('api/categories/delete', $category->id) }}" method="POST">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-delete ml-2" />
        </form>
        @endif
    </div>
</div>
@endsection