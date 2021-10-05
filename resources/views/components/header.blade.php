<div class="card no-bg rounded-0 border-0">
    <div class="pl-4"><small>{{ Config('app.name', 'PFMS') }}</small></div>
    <div class="card-body initial row">
        <h2 class="card-title col-md-8">{{ $title }}</h2>
        <a href="{{ url()->previous() }}" class="btn btn-quick-back shadow-sm h-100">
            <i class="fa fa-angle-left"> </i>
            {{ __(' Back') }}
        </a>
        {{-- refined in component controller i.e. App\View\Components\Header.php --}}
        @if($showCreate)
        <a href="{{ url($link) }}" class="btn btn-add-new shadow-sm h-100 ml-2">
            {{ __('Add New ') }} <i class="fa fa-plus"> </i>
        </a>
        @endif
    </div>
</div>