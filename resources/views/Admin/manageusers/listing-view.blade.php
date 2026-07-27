@extends('layouts.admin')
@section('content')
<div class="container py-5">
    <h3 class="strong">{{ $user->name }} : Listing {{ $listing->id }}</h3><br>

    <p><strong>House Type:</strong> {{$listing->Type}}</p>
    <p><strong>Status: </strong> {{$listing->status}}</p>
    <p><strong>Location:</strong> {{$listing->Location}}</p>

    <p><strong>Price:</strong> {{$listing->Rate}}</p>

    <p><strong>Description:</strong></p>
        @php
            $points = preg_split('/\r\n|\r|\n/', $listing->Description ?? '');
        @endphp
        <ul>
            @foreach($points as $point)
                @if(trim($point) !== '')
                    <li>{{ $point }}</li>
                @endif
            @endforeach
        </ul>

    <p><strong>Pictures</strong></p>
    @if($listing->image)

            <img src="{{ asset('storage/' . $listing->image) }}" alt="Listing Photo" style="width: 200px; height: auto; margin-right: 10px;">
            @if($listing->image_inside)
                <img src="{{ asset('storage/' . $listing->image_inside) }}" alt="Listing Photo" style="width: 200px; height: auto; margin-right: 10px;">
            @endif
            @if($listing->Image_outside)
                <img src="{{ asset('storage/' . $listing->Image_outside) }}" alt="Listing Photo" style="width: 200px; height: auto; margin-right: 10px;">
            @endif
            @if($listing->Amenities)
                <img src="{{ asset('storage/' . $listing->Amenities) }}" alt="Listing Photo" style="width: 200px; height: auto; margin-right: 10px;">
            @endif
    @else
        <p>No photos available for this listing.</p>
    @endif

    <div class="mt-3">
        <a href="{{ route('admin.user.listing.edit', [$listing->landlord_id, $listing->id]) }}" class="btn btn-primary">Edit Listing</a>
        @if ($listing->status === 'active')
            <form action="{{ route('admin.user.listing.suspend', [$listing->landlord_id, $listing->id]) }}" method="POST" class="d-inline">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to suspend this listing?')">Suspend Listing</button>
            </form>
        @else
            <form action="{{ route('admin.user.listing.restore', [$listing->landlord_id, $listing->id]) }}" method="POST" class="d-inline">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to activate this listing?')">Activate Listing</button>
            </form>
        @endif
        <a href="{{ route('admin.user.listings', $listing->landlord_id) }}" class="btn btn-secondary">Back to User Listings</a>
    </div>
</div>
@endsection