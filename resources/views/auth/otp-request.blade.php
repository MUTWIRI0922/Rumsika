@extends('layouts.app')

@section('content')
<style>
    .otp-request-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e0ffe0 0%, #f8f9fa 100%);
    }
    .otp-card {
        border-radius: 1rem;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        border: 2px solid #198754;
        background: #fff;
        max-width: 400px;
        width: 90%;
        padding: 2rem 2rem 1.5rem 2rem;
    }
    .otp-card h3 {
        color: #198754;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }
    .btn-warning {
        width: 90%;
        font-weight: 600;
    }
</style>

<div class="otp-request-container">
    <img class="img-fluid" style=" width:25%; height:auto;" src="{{ asset('images/rumsika.svg') }}" alt="logo"> 

    <div class="otp-card">
        <h3 class="text-center">Request OTP</h3>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('otp.send') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" required autofocus>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-warning">Send OTP</button>
        </form>
    </div>
</div>
@endsection