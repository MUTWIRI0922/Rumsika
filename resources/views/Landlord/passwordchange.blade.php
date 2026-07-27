@extends('layouts.landlord')
@section('title', 'Change Password')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Change Password</h3>
        <p class="text-muted mb-0">Update your password to keep your account secure.</p>
    </div>
</div>
<form method="POST" action="{{ route('landlord.changePassword') }}" class="mb-4 row g-3">
    @csrf
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="form-outline col-md-6 mb-4 position-relative">
        <label for="currentpwd">Current Password</label>
        <input type="password" name="current" class="form-control" id="currentpwd" placeholder="Enter Current Password"><br>
        <span class="position-absolute top-50 end-0 translate-middle-y mt-0 me-3" style="cursor:pointer; height: 100%; display: flex; align-items: center;" onclick="togglePassword()">
            <i class="bi bi-eye fs-3" id="togglePasswordIcon"></i>
        </span>
    </div>

    <div class="form-outline col-md-6 mb-4 position-relative">
        <label for="newpwd">New Password</label>
        <input type="password" name="new" class="form-control" id="newpwd" placeholder="Enter New Password"><br>
        <span class="position-absolute top-50 end-0 translate-middle-y mt-0 me-3" style="cursor:pointer; height: 100%; display: flex; align-items: center;" onclick="togglePassword()">
            <i class="bi bi-eye fs-3" id="togglePasswordIcon"></i>
        </span>
    </div>


    <div class="form-outline col-md-6 mb-4 position-relative">
        <label for="confirmnew">Confirm password</label>
        <input type="password" name="new_confirmation" class="form-control" id="confirmpwd" placeholder="Confirm new password">
        <span class="position-absolute top-50 end-0 translate-middle-y mt-2 me-3" style="cursor:pointer; height: 100%; display: flex; align-items: center;" onclick="togglePassword()">
            <i class="bi bi-eye fs-3" id="togglePasswordIcon"></i>
        </span>
    </div>
    <button type="submit" class="btn btn-success">Change Password</button>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function togglePassword() {
            const input = document.getElementById('currentpwd');
            const icon = document.getElementById('togglePasswordIcon');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    });
</script>
@endsection