@extends('layouts.landlord')
@section('title', 'House Upload')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Add House</h3>
        <p class="text-muted mb-0">Post a new listing with clear details and images.</p>
    </div>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="POST" action="{{ route('house.upload') }}" enctype="multipart/form-data" class="row g-3 mb-4">
    @csrf
    <div class="mb-3">
        <label class="form-label">House Type<span class="text-danger">*</span></label>
        <input type="text" name="type" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Location<span class="text-danger">*</span></label>
        <input type="text" name="location" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description<span class="text-danger">*</span> </label>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Rate<span class="text-danger">*</span></label>
        <input type="number" name="rate" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No. of available units<span class="text-danger">*</span></label>
        <input type="number" name="available_units" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">House Image<span class="text-danger">*</span></label>
        <input type="file" name="image" class="form-control" accept="image/*" required>
    </div>
    <div class="mb-3">
        <label class="form-label">House Image (Inside)</label>
        <input type="file" name="image_inside" class="form-control" accept="image/*">
    </div>
    <div class="mb-3">
        <label class="form-label">House Image (Outside)</label>
        <input type="file" name="Image_outside" class="form-control" accept="image/*">
    </div>
    <div class="mb-3">
        <label class="form-label">Image (Amenities)</label>
        <input type="file" name="Amenities" class="form-control" accept="image/*">
    </div>
    <button type="submit" class="btn btn-success">Upload House</button>
</form>
@endsection