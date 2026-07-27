@extends('layouts.admin')
@section('title', 'View User')
@section('content')
<div class="container py-5">
    <h2>User Details</h2>
    <div class="card mb-4">
        <div class="card-body">
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="img-thumbnail mb-3" style="max-width: 200px;">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone }}</p>
            <p><strong>Status:</strong> {{ $user->status }}</p>
            <p><strong>Registered At:</strong> {{ $user->created_at->format('Y-m-d') }}</p>
            <p><strong>No. of Listings:</strong> {{ $user->listings_count }}</p>
        </div>
    </div>
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
            @method('POST')
            <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to activate this user?')">Activate User</button>
        </form>
    @endif
    <a href="{{ route('admin.users') }}" class="btn btn-secondary">Back to Users List</a>
</div>
    @include('Admin.manageusers.suspendreason')
@endsection