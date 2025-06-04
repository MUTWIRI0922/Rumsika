@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

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

<form method="POST" action="{{ route('house.upload') }}" enctype="multipart/form-data" class="mb-4">
    @csrf
    <div class="mb-3">
        <label class="form-label">House Type</label>
        <input type="text" name="type" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Location</label>
        <input type="text" name="location" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Rate</label>
        <input type="number" name="rate" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">House Image</label>
        <input type="file" name="image" class="form-control" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-success">Upload House</button>
</form>
@endsection