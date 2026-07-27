@extends('layouts.admin')
@section('content')
<div class="container py-5">
    <h2>User Listings - {{ $user->name }}</h2>
    <a href="{{ route('admin.users') }}" class="btn btn-secondary btn-sm">Back to Users List</a>
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <!-- <th>User Id</th>
                <th>Listing Id</th> -->
                <th>Image</th>
                <th>Type</th>
                <th>Location</th>
                <th>Rate</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listings as $listing)
            <tr class="align-content-center">
                <!-- <td>{{ $listing->landlord_id }}</td>
                <td>{{ $listing->id }}</td> -->
                <td>
                    <img src="{{ asset('storage/' . $listing->image) }}" alt="Listing Photo" class="img-thumbnail" style="max-width: 100px;">
                </td>
                <td>{{ $listing->Type }}</td>
                <td>{{ $listing->Location }}</td>
                <td>{{ $listing->Rate }}</td>
                <td>{{ $listing->status }}</td>
                <td>{{ $listing->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.user.listing.details', [$listing->landlord_id, $listing->id]) }}" class="btn btn-sm btn-outline-info">View</a>
                    <a href="{{ route('admin.user.listing.edit', [$listing->landlord_id, $listing->id]) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    @if ($listing->status === 'active')
                        <form action="{{ route('admin.user.listing.suspend', [$listing->landlord_id, $listing->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-outline-warning" onclick="return confirm('Are you sure you want to suspend this listing?')">Suspend</button>
                        </form>
                    @else
                        <form action="{{ route('admin.user.listing.restore', [$listing->landlord_id, $listing->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('Are you sure you want to activate this listing?')">Activate</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No listings found for this user.</td>
            </tr>
            @endforelse
        </tbody>
    </table>


</div>
@endsection