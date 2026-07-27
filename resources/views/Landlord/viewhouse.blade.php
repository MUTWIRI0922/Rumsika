@extends('layouts.landlord')
@section('title', 'view House')
@section('content')
<div class="modal fade" id="viewHouseModal{{ $house->id }}" tabindex="-1" aria-labelledby="viewHouseModalLabel{{ $house->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-sm-mobile">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewHouseModalLabel{{ $house->id }}">House Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Type:</strong> {{ $house->Type }}</p>
                <p><strong>Location:</strong> {{ $house->Location }}</p>
                <p><strong>Description:</strong><br>
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
                </p>
                <p><strong>Rate:</strong> {{ $house->Rate }}</p>
                <p><strong>Views:</strong> {{ $HviewsCount[$house->id] ?? 0 }}</p>
                <div>
                    @if($house->image)
                    <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" width="120" class="me-2 mb-2">
                    @endif
                    @if($house->image_inside)
                    <img src="{{ asset('storage/' . $house->image_inside) }}" alt="Inside" width="120" class="me-2 mb-2">
                    @endif
                    @if($house->Image_outside)
                    <img src="{{ asset('storage/' . $house->Image_outside) }}" alt="Outside" width="120" class="me-2 mb-2">
                    @endif
                    @if($house->Amenities)
                    <img src="{{ asset('storage/' . $house->Amenities) }}" alt="Amenities" width="120" class="me-2 mb-2">
                    @endif
                </div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editHouseModal{{ $house->id }}">
                    <i class="bi bi-pencil"></i> Edit
                </button>
                <form method="POST" action="" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#deleteHouseModal{{ $house->id }}">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
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
                    Are you sure you want to delete this house?
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