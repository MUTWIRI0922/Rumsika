@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h3>Reset Password</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('password.reset') }}">
        @csrf
        <div class="mb-3">
            <label>Email address</label>
            <input type="email" name="email" class="form-control" 
                   value="{{ session('otp_email') }}" readonly required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>New Password</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Reset Password</button>
    </form>
</div>
@endsection