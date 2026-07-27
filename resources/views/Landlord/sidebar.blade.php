<aside class="landlord-sidebar text-white d-flex flex-column p-3 p-lg-4">
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none text-white mb-3 mb-md-4">
        <img class="img-fluid" style="width: 70%; height: auto;" src="{{ asset('images/rumsika.svg') }}" alt="logo">
    </a>

    <nav class="nav flex-column gap-2 mt-2">
        <a class="nav-link text-white rounded-pill px-3 py-2 " href="{{ route('dashboard') }}">
            <i class="bi bi-house"></i><span class="ms-2">Dashboard</span>
        </a>
        <a class="nav-link text-white rounded-pill px-3 py-2 " href="{{ route('dashboard.add-house') }}">
            <i class="bi bi-plus-circle"></i><span class="ms-2">Add House</span>
        </a>
        <a class="nav-link text-white rounded-pill px-3 py-2 " href="">
            <i class="bi bi-list"></i><span class="ms-2">My Houses</span>
        </a>
        <a class="nav-link text-white rounded-pill px-3 py-2 " href="">
            <i class="bi bi-person"></i><span class="ms-2">Profile</span>
        </a>
        <a class="nav-link text-white rounded-pill px-3 py-2 " href="">
            <i class="bi bi-key-fill"></i><span class="ms-2">Change Password</span>
        </a>
        <a class="nav-link text-white rounded-pill px-3 py-2" href="">
            <i class="bi bi-question-circle"></i><span class="ms-2">Support</span>
        </a>
    </nav>
</aside>