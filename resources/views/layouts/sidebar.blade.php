<ul class="list-unstyled mt-2">
    <li class="list-item">
        <a href="{{ route('home') }}">{{ __('Home') }}</a>
    </li>
    <li class="list-item">
        <a href="{{ url('api/balances/index') }}">{{ __('Current Balance') }}</a>
    </li>
    <li class="list-item">
        <a data-toggle="collapse" href="#budgetCollapse" role="button" aria-expanded="false"
            aria-controls="budgetCollapse">Budget</a>
        <ul class="list-unstyled collapse mt-2" id="budgetCollapse">
            <li>
                <a href="{{ url('api/budgets/current') }}">{{ __("View") }}</a>
                <span class="badge badge-success badge-pill">Current</span>
            </li>
            <li>
                <a href="{{ url('api/budgets/create') }}">{{ __('Create') }}</a>
            </li>
            <li>
                <a href="{{ url('api/budgets/index') }}">{{ __('View All') }}</a>
            </li>
        </ul>
    </li>
    <li class="list-item">
        <a data-toggle="collapse" href="#categoryCollapse" role="button" aria-expanded="false"
            aria-controls="categoryCollapse">Category</a>
        <ul class="list-unstyled collapse mt-2" id="categoryCollapse">
            <li>
                <a href="{{ url('api/categories/index') }}">{{ __("View") }}</a>
            </li>
            <li>
                <a href="{{ url('api/categories/create') }}">{{ __('Add') }}</a>
            </li>
        </ul>
    </li>
    <li class="list-item">
        <a data-toggle="collapse" href="#paymentModeCollapse" role="button" aria-expanded="false"
            aria-controls="paymentModeCollapse">Payment Mode</a>
        <ul class="list-unstyled collapse mt-2" id="paymentModeCollapse">
            <li>
                <a href="{{ url('api/payment-modes/index') }}">{{ __("View") }}</a>
            </li>
            <li>
                <a href="{{ url('api/payment-modes/create') }}">{{ __('Add') }}</a>
            </li>
        </ul>
    </li>
    <li class="list-item">
        <a data-toggle="collapse" href="#reminderCollapse" role="button" aria-expanded="false"
            aria-controls="reminderCollapse">Reminder</a>
        <ul class="list-unstyled collapse mt-2" id="reminderCollapse">
            <li>
                <a href="#">{{ __("View") }}</a>
            </li>
            <li>
                <a href="#">{{ __('Add') }}</a>
            </li>
        </ul>
    </li>
    <li class="list-item">
        <a data-toggle="collapse" href="#transactionCollapse" role="button" aria-expanded="false"
            aria-controls="transactionCollapse">Transaction</a>
        <ul class="list-unstyled collapse mt-2" id="transactionCollapse">
            <li>
                <a href="{{ url('api/transactions/index') }}">{{ __("View") }}</a>
            </li>
            <li>
                <a href="{{ url('api/transactions/create') }}">{{ __('Create') }}</a>
            </li>
        </ul>
    </li>
</ul>