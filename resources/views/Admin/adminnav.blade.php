<aside id="adminSidebar" class="sidebar bg-white border-end shadow-sm d-flex flex-column p-3">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <a href="{{ route('admin.dashboard') }}" class="d-inline-flex align-items-center text-decoration-none">
            <img src="{{ asset('images/rumsika.svg') }}" alt="Rumsika" class="img-fluid" style="height:40px;" />
        </a>

    </div>

    <nav class="nav nav-pills flex-column gap-2">
        <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.kyc.requests') }}" class="nav-link d-flex align-items-center">
            <i class="bi bi-person-badge me-2"></i>
            <span>KYC Requests</span>
        </a>
        <a href="{{ route('admin.users') }}" class="nav-link d-flex align-items-center">
            <i class="bi bi-people-fill me-2"></i>
            <span>Users</span>
        </a>
        <a href="#" class="nav-link d-flex align-items-center">
            <i class="bi bi-bar-chart-line-fill me-2"></i>
            <span>Reports</span>
        </a>
        <a href="#" class="nav-link d-flex align-items-center">
            <i class="bi bi-gear-fill me-2"></i>
            <span>Settings</span>
        </a>
    </nav>

    <div class="mt-auto pt-4 border-top">
        <div class="mb-2 px-2 text-secondary sidebar-title">Quick links</div>
        <a href="#" class="nav-link d-flex align-items-center text-dark px-2 py-2 rounded">
            <i class="bi bi-calendar-check me-2"></i>
            <span>Activity log</span>
        </a>
        <a href="#" class="nav-link d-flex align-items-center text-dark px-2 py-2 rounded">
            <i class="bi bi-question-circle me-2"></i>
            <span>Support</span>
        </a>
        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="nav-link d-flex align-items-center text-dark px-2 py-2 rounded border-0 bg-transparent w-100 text-start">
                <i class="bi bi-box-arrow-right me-2"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
