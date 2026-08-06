@extends('layouts.landlord')
@section('title', 'Houses listed')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">My Houses</h3>
        <p class="text-muted mb-0">Manage your listings and monitor activity from one place.</p>
    </div>
</div>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Location</th>
                <th>Description</th>
                <th>Time</th>
                <th>Rate</th>
                <th>Available Units</th>
                <th>Views</th>
                <th>Image</th>
                <th>Actions</th> {{-- New column for buttons --}}
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @forelse($houses as $index => $house)
            <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $house->Type }}</td>
                <td>{{ $house->Location }}</td>
                <td>
                    @php
                    $points = preg_split('/\r\n|\r|\n/', $house->Description ?? '');
                    @endphp

                    <ul>
                        @foreach($points as $point)
                        @if(trim($point) !== '')
                        <li>{{ $point }}</li>
                        @endif
                        @endforeach
                    </ul>
                </td>
                <td>
                    <p>{{ $house->created_at->diffForHumans(null, null, true) ?? 'N/A' }}</p>
                </td>
                <td>{{ $house->Rate }}</td>
                <td>{{ $house->available_units }}</td>
                <td>{{$HviewsCount[$house->id] ?? 0}}</td>
                <td>
                    @if($house->image)
                    <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" width="60">
                    @else
                    N/A
                    @endif
                </td>
                <td>
                    <!-- actions button -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical fs-6"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('landlord.house.details', $house->id) }}">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard.edit-house', $house->id) }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('house.delete', $house->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteHouseModal{{ $house->id }}">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- delete house modal -->
                    <div class="modal fade" id="deleteHouseModal{{ $house->id }}" tabindex="-1" aria-labelledby="deleteHouseModalLabel{{ $house->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteHouseModalLabel{{ $house->id }}">Delete House</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    This action is irreversible. Are you sure you want to delete this house?
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="{{ route('house.delete', $house->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">No houses found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection