@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <img class="img-fluid" style=" width:25%; height:auto;" src="{{ asset('images/rumsika.svg') }}" alt="logo"> 

    <h3>Verify OTP</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf
        <div class="mb-3">
            <label>Email address</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>OTP</label>
            <input type="text" name="otp" class="form-control" required>
            @error('otp') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-success">Verify OTP</button>
    </form>
</div>
@endsection