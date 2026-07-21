
@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h1 class="display-6 fw-bold">Admin Dashboard</h1>
            <p class="text-muted mb-0">Overview of pending KYC requests, system status, and quick admin actions.</p>
        </div>
        <div class="text-md-end">
            <p class="text-muted mb-1">Today: {{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-success btn-sm">
                <i class="bi bi-house-door-fill me-1"></i> Admin Home
            </a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-success p-3 rounded-circle">
                                <i class="bi bi-person-badge-fill fs-4"></i>
                            </span>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase">Pending KYC</small>
                            <h3 class="mb-0">18</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
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
                            <h3 class="mb-0">320</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
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
                            <h3 class="mb-0">12</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-secondary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-secondary p-3 rounded-circle">
                                <i class="bi bi-gear-fill fs-4"></i>
                            </span>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase">System Health</small>
                            <h3 class="mb-0">Stable</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8">
            <div class="card shadow-sm my-2">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Recent Signups</h5>
                        <p class="text-muted mb-0">Review the latest user registrations</p>
                    </div>
                    <span class="badge bg-success">New</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>KYC Status</th>
                                <th>KYC score</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kycRequests ?? [] as $request)
                                <tr>
                                    <td>{{ $request->user_name ?? 'Unknown User' }}</td>
                                    <td>{{ $request->id_photo ? 'Uploaded' : 'Missing' }}</td>
                                    <td>{{ $request->selfie ? 'Uploaded' : 'Missing' }}</td>
                                    <td>{{ $request->score ?? '—' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $request->status == 'approved' ? 'success' : ($request->status == 'rejected' ? 'danger' : 'secondary') }}">
                                            {{ ucfirst($request->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <form method="POST" action="{{ $request->action_url ?? '#' }}" class="d-inline-flex gap-2">
                                            @csrf
                                            @if(isset($request->id))
                                                @method('PUT')
                                            @endif
                                            <button name="action" value="approve" class="btn btn-secondary btn-sm">View Details</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Jane Doe</td>
                                    <td>Janedoe@gmail.com</td>
                                    <td>0796635581</td>
                                    <td>Initiated</td>
                                    <td>91</td>
                                    <td class="text-end">
                                        <form method="POST" action="#" class="d-inline-flex gap-2">
                                            @csrf
                                            @method('PUT')
                                            <button name="action" value="view" class="btn btn-secondary btn-sm">View Details</button>
                                        </form>
                                    </td>
                                </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white text-end">
                    <a href="#" class="text-decoration-none text-success">View all<i class="bi bi-arrow-right-short"></i></a>
                </div>
            </div>
            <div class="card shadow-sm my-2">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Pending KYC Requests</h5>
                        <p class="text-muted mb-0">Review the latest verification submissions and approve or reject requests.</p>
                    </div>
                    <span class="badge bg-warning text-dark">Needs attention</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>User</th>
                                <th>ID Photo</th>
                                <th>Selfie</th>
                                <th>Score</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kycRequests ?? [] as $request)
                                <tr>
                                    <td>{{ $request->user_name ?? 'Unknown User' }}</td>
                                    <td>{{ $request->id_photo ? 'Uploaded' : 'Missing' }}</td>
                                    <td>{{ $request->selfie ? 'Uploaded' : 'Missing' }}</td>
                                    <td>{{ $request->score ?? '—' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $request->status == 'approved' ? 'success' : ($request->status == 'rejected' ? 'danger' : 'secondary') }}">
                                            {{ ucfirst($request->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <form method="POST" action="{{ $request->action_url ?? '#' }}" class="d-inline-flex gap-2">
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
                                    <td>Jane Doe</td>
                                    <td>Uploaded</td>
                                    <td>Uploaded</td>
                                    <td>91</td>
                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                    <td class="text-end">
                                        <form method="POST" action="#" class="d-inline-flex gap-2">
                                            @csrf
                                            @method('PUT')
                                            <button name="action" value="view" class="btn btn-secondary btn-sm">View Details</button>
                                            <button name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                                            <button name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Michael Carter</td>
                                    <td>Uploaded</td>
                                    <td>Uploaded</td>
                                    <td>87</td>
                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                    <td class="text-end">
                                        <form method="POST" action="#" class="d-inline-flex gap-2">
                                            @csrf
                                            @method('PUT')
                                            <button name="action" value="view" class="btn btn-secondary btn-sm">View Details</button>
                                            <button name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                                            <button name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    </td>
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
        <div class="col-xl-4">
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
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
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

