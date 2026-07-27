@extends('layouts.landlord')
@section('title', 'Landlord Profile')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Your Profile</h3>
        <p class="text-muted mb-0">View and update your account details.</p>
    </div>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<form class="mb-4" id="profileForm" method="POST" action="">
    @csrf

    <div class="row">
        <div class="col-6 mb-4 text-center">
            @if(!empty($landlord->profile_picture))
            <img src="{{ asset('storage/' . $landlord->profile_picture) }}" alt="Profile Picture" class="rounded-circle" width="120" height="120" style="object-fit:cover;">
            @else
            <img src="{{ asset('images/profile avator.jpg') }}" alt="Profile Picture" class="rounded-circle" width="120" height="120" style="object-fit:cover;">
            @endif
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" value="{{ $landlord->name ?? '' }}" readonly>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="{{ $landlord->email ?? '' }}" readonly>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" value="{{ $landlord->phone ?? '' }}" readonly>
        </div>
    </div>

    <button type="button" class="btn btn-primary" id="editBtn" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
    <button type="button" class="btn btn-primary" id="kycVerifyBtn" data-bs-toggle="modal" data-bs-target="#kycVerifyModal">KYC Verify</button>
    <button type="submit" class="btn btn-success d-none" id="saveBtn">Save</button>
</form>
<script>
    document.getElementById('editBtn').onclick = function() {
        let form = document.getElementById('profileForm');
        form.querySelectorAll('input').forEach(input => input.removeAttribute('readonly'));
        document.getElementById('saveBtn').classList.remove('d-none');
        this.classList.add('d-none');
    };
</script>
@endsection