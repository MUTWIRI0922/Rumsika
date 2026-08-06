@extends('layouts.landlord')
@section('title','Edit Profile')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Edit Profile</h3>
        <p class="text-muted mb-0">Keep your landlord account details up to date.</p>
    </div>
</div>

<form method="POST" action="{{ route('landlord.updateProfile', $landlord->id) }}" id="editProfileForm" enctype="multipart/form-data" class="row g-3">
    @csrf

    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 text-center">
                <div class="position-relative d-inline-block mb-3">
                    @if(!empty($landlord->profile_picture))
                    <img id="profilePicPreview" src="{{ asset('storage/' . $landlord->profile_picture) }}" alt="Profile Picture" class="rounded-circle" width="140" height="140" style="object-fit:cover;">
                    @else
                    <img id="profilePicPreview" src="{{ asset('images/profile avator.jpg') }}" alt="Profile Picture" class="rounded-circle" width="140" height="140" style="object-fit:cover;">
                    @endif
                    <label for="profilePicInput" class="position-absolute bottom-0 end-0 bg-white rounded-circle p-2 shadow" style="cursor:pointer;">
                        <i class="bi bi-pencil text-primary"></i>
                        <input type="file" id="profilePicInput" name="profile_picture" accept="image/*" class="d-none">
                    </label>
                </div>
                <p class="text-muted mb-0">Upload a new profile photo to personalize your account.</p>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $landlord->name ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $landlord->email ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ $landlord->phone ?? '' }}">
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('dashboard', ['section' => 'profile']) }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    // Handle profile picture preview
    document.querySelectorAll('#profilePicInput').forEach(function(input) {
        input.addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                // Find the closest preview image in the same modal/form
                const preview = event.target.closest('div.position-relative').querySelector('#profilePicPreview');
                if (preview) {
                    preview.src = URL.createObjectURL(file);
                }
            }
        });
    });
</script>
@endsection