@extends('layouts.app')
@section('content')
<style>
        body {
        margin: 0;
        font-family: 'Segoe UI', Roboto, Arial, sans-serif;
        background:
            linear-gradient(135deg, rgba(3, 27, 16, 0.86), rgba(9, 82, 47, 0.78)),
            url('{{ asset('images/exterior-design-shutterstock_1932966368-1200x700-compressed.jpg') }}') center/cover no-repeat;
        min-height: 100vh;
    }
    .otp-logo {
        width: 25%;
        height: auto;
        display: block;
        margin: 0 auto 1.5rem auto;
        min-width: 120px;
        max-width: 180px;
    }
    label {
        color: #fff;
    }
</style>
<div class="container mt-5">
    <img class="img-fluid otp-logo" src="{{ asset('images/rumsika.svg') }}" alt="logo">
    <h3 class="text-white">Reset Password</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form method="POST" action="{{ route('password.reset') }}">
        @csrf
        <div class="mb-3">
            <label for="email">Email address</label>
            <input type="email" name="email" id="email" class="form-control" 
                   value="{{ session('otp_email') }}" readonly required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Reset Password</button>
    </form>
</div>
@endsection