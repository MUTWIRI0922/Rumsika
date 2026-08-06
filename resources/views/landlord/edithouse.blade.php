@extends('layouts.landlord')
@section('title', 'Edit House')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Edit House</h3>
        <p class="text-muted mb-0">Update your listing details and images.</p>
    </div>
</div>

<form method="POST" action="{{ route('house.update', $house->id) }}" enctype="multipart/form-data" class="row g-3">
    @csrf
    @method('PUT')

    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label">Type <span class="text-danger">*</span></label>
                    <input type="text" name="type" class="form-control" value="{{ $house->Type }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Location <span class="text-danger">*</span></label>
                    <input type="text" name="location" class="form-control" value="{{ $house->Location }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control" rows="5" required>{{ $house->Description }}</textarea>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Rate <span class="text-danger">*</span></label>
                        <input type="number" name="rate" class="form-control" value="{{ $house->Rate }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Available units <span class="text-danger">*</span></label>
                        <input type="number" name="available_units" class="form-control" value="{{ $house->available_units }}" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label">Main Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if($house->image)
                        <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" class="img-fluid rounded mt-3" style="max-height: 140px; object-fit: cover;">
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Inside Image</label>
                    <input type="file" name="image_inside" class="form-control" accept="image/*">
                    @if($house->image_inside)
                        <img src="{{ asset('storage/' . $house->image_inside) }}" alt="Inside" class="img-fluid rounded mt-3" style="max-height: 140px; object-fit: cover;">
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Outside Image</label>
                    <input type="file" name="Image_outside" class="form-control" accept="image/*">
                    @if($house->Image_outside)
                        <img src="{{ asset('storage/' . $house->Image_outside) }}" alt="Outside" class="img-fluid rounded mt-3" style="max-height: 140px; object-fit: cover;">
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Amenities Image</label>
                    <input type="file" name="Amenities" class="form-control" accept="image/*">
                    @if($house->Amenities)
                        <img src="{{ asset('storage/' . $house->Amenities) }}" alt="Amenities" class="img-fluid rounded mt-3" style="max-height: 140px; object-fit: cover;">
                    @endif
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('dashboard', ['section' => 'my-houses']) }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection