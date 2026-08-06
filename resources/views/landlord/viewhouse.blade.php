@extends('layouts.landlord')
@section('title', 'House Details')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">House Details</h3>
        <p class="text-muted mb-0">View and manage the selected listing.</p>
    </div>
    <a href="{{ route('landlord.houses') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Houses
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h4 class="mb-1">{{ Str::title($house->Type)     }}</h4>
                <p class="text-muted mb-0">{{ $house->Location }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('dashboard.edit-house', $house->id) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form method="POST" action="" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="dropdown-item text-danger btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteHouseModal{{ $house->id }}">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <div class=" g-4">
            <div class="">
                <p><strong>Type:</strong> {{ $house->Type }}</p>
                <p><strong>Location:</strong> {{ $house->Location }}</p>
                <p><strong>Rate:</strong> {{ $house->Rate }}</p>
                <p><strong>Views:</strong> {{ $HviewsCount[$house->id] ?? 0 }}</p>
                <p><strong>Description:</strong></p>
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
            </div>
            <div class="">
                <div class="row g-3">
                    @if($house->image)
                    <div class="col-6 col-md-3">
                        <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" class="img-fluid rounded">
                    </div>
                    @endif
                    @if($house->image_inside)
                    <div class="col-6 col-md-3">
                        <img src="{{ asset('storage/' . $house->image_inside) }}" alt="Inside" class="img-fluid rounded">
                    </div>
                    @endif
                    @if($house->Image_outside)
                    <div class="col-6 col-md-3">
                        <img src="{{ asset('storage/' . $house->Image_outside) }}" alt="Outside" class="img-fluid rounded">
                    </div>
                    @endif
                    @if($house->Amenities)
                    <div class="col-6 col-md-3">
                        <img src="{{ asset('storage/' . $house->Amenities) }}" alt="Amenities" class="img-fluid rounded">
                    </div>
                    @endif
                </div>
            </div>
        </div>
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
</div>
@endsection