<aside id="landlordSidebar" class="landlord-sidebar text-white d-flex flex-column p-3 p-lg-4">
    <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none text-white">
            <img class="img-fluid" style="width: 70%; height: auto;" src="{{ asset('images/rumsika.svg') }}" alt="logo">
        </a>
        <button type="button" class="btn btn-link text-white p-0 d-md-none" id="closeSidebarMobile" aria-label="Close menu">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <nav class="nav flex-column gap-2 mt-2">
        <a class="nav-link text-white rounded-pill px-3 py-2" href="{{ route('dashboard') }}">
            <i class="bi bi-house"></i><span class="ms-2">Dashboard</span>
        </a>
        <a class="nav-link text-white rounded-pill px-3 py-2" href="{{ route('dashboard.add-house') }}">
            <i class="bi bi-plus-circle"></i><span class="ms-2">Add House</span>
        </a>
        <a class="nav-link text-white rounded-pill px-3 py-2" href="{{ route('landlord.houses') }}">
            <i class="bi bi-list"></i><span class="ms-2">My Houses</span>
        </a>
        <a class="nav-link text-white rounded-pill px-3 py-2" href="{{ route('landlord.profile') }}">
            <i class="bi bi-person"></i><span class="ms-2">Profile</span>
        </a>
        <a class="nav-link text-white rounded-pill px-3 py-2" href="{{ route('landlord.passwordchange') }}">
            <i class="bi bi-key-fill"></i><span class="ms-2">Change Password</span>
        </a>
        <a class="nav-link text-white rounded-pill px-3 py-2" href="{{ route('landlord.support') }}">
            <i class="bi bi-question-circle"></i><span class="ms-2">Support</span>
        </a>
        <a class="nav-link text-white rounded-pill px-3 py-2" href="{{ route('landlord.logout') }}">
            <i class="bi bi-box-arrow-right"></i><span class="ms-2">Logout</span>
        </a>
    </nav>
</aside>