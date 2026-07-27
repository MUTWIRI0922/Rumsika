
@extends('layouts.admin')

@section('title', 'Admin Dashboard - Rumsika')

@section('content')
<div class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h1 class="display-6 fw-bold">Admin Dashboard</h1>
            <p class="text-muted mb-0">Overview of pending KYC requests, system status, and quick admin actions.</p>
        </div>
        <div class="text-md-end">
            <p class="text-muted mb-1">Today: {{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-6 col-md-3 mb-3 mb-md-0">
            <div class="card shadow-sm border-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-success p-3 rounded-circle">
                                <i class="bi bi-person-badge-fill fs-4"></i>
                            </span>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase">Total Users</small>
                            <h3 class="mb-0">{{ $totalUsers }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3 mb-md-0">
            <div class="card shadow-sm border-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-primary p-3 rounded-circle">
                                <i class="bi bi-eye-fill fs-4"></i>
                            </span>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase">Daily Views</small>
                            <h3 class="mb-0">{{ $dailyViews }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3 mb-md-0">
            <div class="card shadow-sm border-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-warning text-dark p-3 rounded-circle">
                                <i class="bi bi-chat-left-text-fill fs-4"></i>
                            </span>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase">New Enquiries</small>
                            <h3 class="mb-0">{{ $totalEnquiries }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3 mb-md-0">
            <div class="card shadow-sm border-secondary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-secondary p-3 rounded-circle">
                                <i class="bi bi-gear-fill fs-4"></i>
                            </span>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase">Total Listings</small>
                            <h3 class="mb-0">{{ $totalListings }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-12 col-md-8">
            <div class="card shadow-sm my-2">
                <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
                    <div>
                        <h5 class="mb-1">Recent Signups</h5>
                        <p class="text-muted mb-0">Review the latest user registrations</p>
                    </div>
                    <span class="badge bg-success">New</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-sm align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell">Email</th>
                                <th class="d-none d-sm-table-cell">Phone</th>
                                <th class="d-none d-sm-table-cell">Signup date</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers as $recentUser)
                                <tr>
                                    <td>{{ Str::title($recentUser->name ?? 'Unknown User') }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $recentUser->email ?? '—' }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $recentUser->phone ?? '—' }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $recentUser->created_at ? $recentUser->created_at->format('Y-m-d') : '—' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $recentUser->status == 'active' ? 'success' : ($recentUser->status == 'suspended' ? 'danger' : 'secondary') }}">
                                            {{ ucfirst($recentUser->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.user.details', $recentUser->id) }}" class="btn btn-sm btn-secondary">View Details</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white text-end">
                    <a href="{{ route('admin.users') }}" class="text-decoration-none text-success">View all<i class="bi bi-arrow-right-short"></i></a>
                </div>
            </div>
            <div class="card shadow-sm my-2">
                <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
                    <div>
                        <h5 class="mb-1">Pending KYC Requests</h5>
                        <p class="text-muted mb-0">Review the latest verification submissions and approve or reject requests.</p>
                    </div>
                    <span class="badge bg-warning text-dark">Needs attention</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-sm align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>User</th>
                                <th class="d-none d-sm-table-cell">ID Photo</th>
                                <th class="d-none d-sm-table-cell">Selfie</th>
                                <th>Score</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kycRequests ?? [] as $request)
                                <tr>
                                    <td>{{ $request->user_name ?? 'Unknown User' }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $request->id_photo ? 'Uploaded' : 'Missing' }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $request->selfie ? 'Uploaded' : 'Missing' }}</td>
                                    <td>{{ $request->score ?? '—' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $request->status == 'approved' ? 'success' : ($request->status == 'rejected' ? 'danger' : 'secondary') }}">
                                            {{ ucfirst($request->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <form method="POST" action="{{ $request->action_url ?? '#' }}" class="d-flex flex-column flex-sm-row gap-2 justify-content-end">
                                            @csrf
                                            @if(isset($request->id))
                                                @method('PUT')
                                            @endif
                                            <button name="action" value="approve" class="btn btn-secondary btn-sm">View Details</button>
                                            <button name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                                            <button name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Coming soon.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white text-end">
                    <a href="#" class="text-decoration-none text-success">View all requests <i class="bi bi-arrow-right-short"></i></a>
                </div>
            </div> 
        </div>
        <div class="col-12 col-md-4 ">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Review KYC queue
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Export reports
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Manage users
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        View system logs
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">System summary</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Active sessions</span>
                            <strong>42</strong>
                        </div>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 70%;"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Server uptime</span>
                            <strong>99.9%</strong>
                        </div>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 99.9%;"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between">
                            <span>Open tickets</span>
                            <strong>8</strong>
                        </div>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 45%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

