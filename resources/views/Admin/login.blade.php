@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<style>
    .admin-login-page {
        min-height: 100vh;
        background:
            linear-gradient(135deg, rgba(4, 33, 24, 0.82), rgba(8, 92, 56, 0.72)),
            url('{{ asset('images/exterior-design-shutterstock_1932966368-1200x700-compressed.jpg') }}') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }

    .auth-card {
        border-radius: 24px;
        overflow: hidden;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.96);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
    }

    .hero-panel {
        position: relative;
        min-height: 100%;
    }

    .hero-panel img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0.65));
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 32px;
        color: #fff;
    }

    .hero-overlay h2 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .hero-overlay p {
        font-size: 1rem;
        opacity: 0.95;
        max-width: 360px;
    }

    .brand-badge {
        width: 62px;
        height: 62px;
        border-radius: 16px;
        background: linear-gradient(135deg, #0f9d58, #16a34a);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(22, 163, 74, 0.25);
    }

    .admin-login-form .form-control {
        border-radius: 12px;
        padding: 0.8rem 0.95rem;
        border: 1px solid #dbe4de;
        box-shadow: none;
    }

    .admin-login-form .form-control:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 0.2rem rgba(22, 163, 74, 0.17);
    }

    .submit-btn {
        border-radius: 999px;
        padding: 0.8rem 1rem;
        font-weight: 600;
        background: linear-gradient(135deg, #0f9d58, #16a34a);
        border: none;
    }

    .submit-btn:hover {
        background: linear-gradient(135deg, #0d8a4f, #15803d);
    }
</style>

<div class="admin-login-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="auth-card">
                    <div class="row g-0">
                        <div class="col-lg-7 hero-panel d-none d-lg-block">
                            <img src="{{ asset('images/exterior-design-shutterstock_1932966368-1200x700-compressed.jpg') }}" alt="Luxury property background">
                            <div class="hero-overlay">
                                <div class="brand-badge mb-3">
                                    <i class="bi bi-shield-lock-fill fs-4 text-white"></i>
                                </div>
                                <h2>Secure control center</h2>
                                <p>Manage listings, users, verifications, and property activity from one polished dashboard.</p>
                            </div>
                        </div>

                        <div class="col-lg-5 p-4 p-md-5">
                            <div class="text-center mb-4">
                                <img class="img-fluid" style="height: 58px;" src="{{ asset('images/rumsika.svg') }}" alt="Rumsika logo">
                                <h3 class="fw-bold mt-3 mb-1">Admin Portal</h3>
                                <p class="text-muted mb-0">Sign in to continue to your dashboard</p>
                            </div>
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <form class="admin-login-form mt-4" action="{{ route('admin.login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" placeholder="Enter your email..." name="email">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe">
                                        <label class="form-check-label small text-muted" for="rememberMe">Remember me</label>
                                    </div>
                                    <a href="#" class="small text-success text-decoration-none">Forgot password?</a>
                                </div>

                                <button type="submit" class="btn btn-success w-100 submit-btn">Sign in</button>
                            </form>

                            <div class="text-center mt-4 small text-muted">
                                <i class="bi bi-shield-check me-1"></i> Protected by secure admin authentication
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection