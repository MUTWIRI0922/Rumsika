@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h3>Request OTP</h3>
    
    <form method="POST" action="{{ route('otp.send') }}">
        @csrf
        <div class="mb-3">
            <label>Email address</label>
            <input type="email" name="email" class="form-control" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-warning">Send OTP</button>
    </form>
</div>
@endsection