<aside class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
        <div class="media d-flex align-items-center">
            <img loading="lazy" src="{{ asset('icons/robot.svg') }}" alt="robot icon" width="80" height="80"
                class="mr-3 rounded-circle img-thumbnail shadow-sm">
            <div class="media-body">
                <h4 class="m-0 text-6 font-weight-bold">{{ Auth::user()->name }}</h4>
                <i class="fa fa-cirle text-success mr-3"></i>
                <small class="font-weight-normal text-muted mb-0">
                    Admin
                </small>
            </div>
        </div>
    </div>

    <p class="text-gray font-weight-bold text-uppercase px-3 small mb-0">Dashboard</p>

    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
            <a href="{{ url('api/home') }}"
                class="nav-link text-dark {{ request()->is('api/home') ? 'bg-light' : "" }}">
                <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                Home
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('api/balances/index') }}"
                class="nav-link text-dark {{ request()->is('api/balances/index') ? 'bg-light' : "" }}">
                <i class="fa fa-gg-circle mr-3 text-primary fa-fw"></i>
                Balances
            </a>
        </li>
    </ul>

    <p class="text-gray font-weight-bold text-uppercase px-3 pt-2 small mb-0">Budget</p>
    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
            <a href="{{ url('api/budgets/current') }}"
                class="nav-link text-dark {{ request()->is('api/budgets/current') ? "bg-light" : "" }}">
                <i class="fa fa-check mr-3 text-primary fa-fw"></i>
                Active Budget
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('api/budgets/create') }}"
                class="nav-link text-dark {{ request()->is('api/budgets/create') ? "bg-light" : "" }}">
                <i class="fa fa-plus-circle mr-3 text-primary fa-fw"></i>
                Create a New One
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('api/budgets/index') }}"
                class="nav-link text-dark {{ request()->is('api/budgets/index') ? "bg-light" : "" }}">
                <i class="fa fa-table mr-3 text-primary fa-fw"></i>
                View All Budgets
            </a>
        </li>
    </ul>

    <p class="text-gray font-weight-bold text-uppercase px-3 pt-2 small mb-0">Category</p>
    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
            <a href="{{ url('api/categories/create') }}"
                class="nav-link text-dark {{ request()->is('api/categories/create') ? "bg-light" : "" }}">
                <i class="fa fa-plus-circle mr-3 text-primary fa-fw"></i>
                Create a New One
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('api/categories/index') }}"
                class="nav-link text-dark {{ request()->is('api/categories/index') ? "bg-light" : "" }}">
                <i class="fa fa-table mr-3 text-primary fa-fw"></i>
                View All Categories
            </a>
        </li>
    </ul>

    <p class="text-gray font-weight-bold text-uppercase px-3 pt-2 small mb-0">Payment Options</p>
    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
            <a href="{{ url('api/payment-options/create') }}" class="nav-link text-dark">
                <i class="fa fa-plus-circle mr-3 text-primary fa-fw"></i>
                Create a New One
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('api/payment-options/index') }}" class="nav-link text-dark">
                <i class="fa fa-table mr-3 text-primary fa-fw"></i>
                View Payment Options
            </a>
        </li>
    </ul>

    <p class="text-gray font-weight-bold text-uppercase px-3 pt-2 small mb-0">Transactions</p>
    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
            <a href="{{ url('api/transactions/create') }}" class="nav-link text-dark">
                <i class="fa fa-plus-circle mr-3 text-primary fa-fw"></i>
                Create a New One
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('api/transactions/index') }}" class="nav-link text-dark">
                <i class="fa fa-table mr-3 text-primary fa-fw"></i>
                View Transactions
            </a>
        </li>
    </ul>
    <footer class="footer mt-2">
        <div class="w-100">
            <div class="text-center">
                <small>Designed &amp; Developed by iBishek</small>
            </div>
            <div class="text-center">
                Free to Use
            </div>
        </div>
    </footer>
    <section class="mt-2 mb-2 sidebar-accessory">
        <div class="row">
            <div class="col-4">
                <a href="#"><i class="fa fa-user-circle text-2"></i></a>
            </div>
            <div class="col-4">
                <a href="#"><i class="fa fa-cog text-2"></i></a>
            </div>
            <div class="col-4">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out text-2"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </section>
</aside>