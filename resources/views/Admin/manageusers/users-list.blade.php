@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h2>Users List</h2>
    <!-- user search form  -->
    <form action="{{ route('admin.users.search') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search users with name or phone....." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Registered At</th>
                <th>Status</th>
                <th>No. of listings</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                <td>{{ $user->status }}</td>
                <td>{{ $user->listings_count }}</td>
                <td>
                    <a href="{{ route('admin.user.listings', $user->id) }}" class="btn btn-sm btn-info">View listings</a>
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    @if ($user->status === 'active')
                        <button
                            type="button"
                            class="btn btn-sm btn-warning suspend-user-btn"
                            data-user-id="{{ $user->id }}"
                            data-user-name="{{ $user->name }}"
                        >
                            Suspend account
                        </button>
                    @else
                        <form action="{{ route('admin.user.activate', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to activate this user?')">Activate account</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $users->links() }}
</div>

 @include('Admin.manageusers.suspendreason')
@endsection 