<div>
    <div class="card rounded-0 border-0">
        <div class="card-body row">
            <h2 class="card-title col-md-8">{{ $title }}</h2>
            <a href="javascript:void(0)" onclick="window.history.back();"
                class="btn btn-info h-100">{{ __('Quick Back') }}</a>
            {{-- refined in component controller i.e. App\View\Components\Header.php --}}
            @if($showCreate)
            <a href="{{ url($link) }}" class="btn btn-primary h-100 ml-2">Add New</a>
            @endif
        </div>
    </div>
</div>