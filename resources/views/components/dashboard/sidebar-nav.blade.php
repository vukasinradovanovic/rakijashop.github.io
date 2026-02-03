<nav class="sidebarNav bg-body-tertiary">
    <a href="{{ route('dashboard.index') }}">
        <h1 class="sidebarNav_header">Dashboard</h1>
    </a>
    <ul class="sidebarNav_holder">
        @foreach (__('dashboard.sidebar-nav') as $item)
            <li class="nav-item mx-2 mb-4 mb-lg-0">
                <a class="nav-link" href="{{ $item['slug'] }}">{{ $item['name'] }}</a>
            </li>
        @endforeach
    </ul>
</nav>