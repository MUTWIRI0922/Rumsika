@extends('layouts.app')
@section('title', 'Landlord Login')
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

    .auth-shell {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }

    .auth-card {
        width: 100%;
        max-width: 1100px;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(8px);
        position: relative;
    }

    .intro-panel {
        position: relative;
        z-index: 1;
        background: transparent;
        color: #fff;
        padding: 42px 36px;
        display: flex;
        flex-direction: column;
        justify-content: center;

    }


    .intro-panel .brand-mark {
        width: 62px;
        height: 62px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.16);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.16);
    }

    .intro-panel h1 {
        font-size: 1.7rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .intro-panel p {
        font-size: 1rem;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.92);
        margin-bottom: 0;
    }

    .form-panel {
        padding: 38px 34px;
        background: #fff;
    }

    .form-panel h2 {
        font-size: 1.65rem;
        font-weight: 700;
        color: #103b2b;
        margin-bottom: 8px;
    }

    .form-panel .subtext {
        color: #6b7280;
        font-size: 0.95rem;
        margin-bottom: 24px;
    }

    .form-control {
        border-radius: 12px;
        padding: 0.8rem 0.95rem;
        border: 1px solid #d7e1da;
        box-shadow: none;
    }

    .form-control:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 0.2rem rgba(22, 163, 74, 0.16);
    }

    .btn-login {
        border-radius: 999px;
        background: linear-gradient(135deg, #0f9d58, #16a34a);
        color: #fff;
        padding: 0.8rem 1rem;
        font-weight: 600;
        border: none;
    }

    .btn-login:hover {
        color: #fff;
        background: linear-gradient(135deg, #0d8a4f, #15803d);
    }

    .text-link {
        color: #0f9d58;
        text-decoration: none;
        font-weight: 600;
    }

    .text-link:hover {
        color: #0b6b3c;
        text-decoration: underline;
    }

    input:focus {
        border-color: #16a34a !important;
        box-shadow: 0 0 0 0.2rem rgba(22, 163, 74, 0.16);
    }

    @media (max-width: 991px) {
        .intro-panel {
            padding: 28px 24px;
        }
    }
</style>

<div class="auth-shell">
    <div class="container-fluid px-0">
        <div class="row justify-content-center g-0">
            <div class="col-xl-10">
                <div class="auth-card row g-0 align-items-stretch">
                    <div class="col-lg-6 intro-panel">
                        <div class="brand-mark">
                            <i class="bi bi-house-check-fill fs-3"></i>
                        </div>
                        <h1>Welcome back, landlord</h1>
                        <p>Connect with tenants, manage your property listings, and grow your rental business from a secure and elegant portal.</p>
                    </div>

                    <div class="col-lg-6 form-panel">
                        <div class="text-center mb-4">
                            <img class="img-fluid" style="height: 58px;" src="{{ asset('images/rumsika.svg') }}" alt="Rumsika logo">
                        </div>

                        <h2 class="text-center">Landlord Login</h2>
                        <p class="subtext text-center">Sign in to continue to your dashboard</p>

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

                        <form method="POST" action="{{ route('landlord.login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="Email" class="form-label fw-semibold">Email address</label>
                                <input type="email" id="Email" name="email" class="form-control form-control-lg" placeholder="Enter your email" autofocus />
                            </div>

                            <div class="mb-3 position-relative">
                                <label for="passwordInput" class="form-label fw-semibold">Password</label>

                                <input type="password" id="passwordInput" name="password" class="form-control form-control-lg" placeholder="Enter your password" />
                                <span class="position-absolute top-50 end-0 translate-middle-y mt-2 me-3" style="cursor:pointer; display:flex; align-items:center;" onclick="togglePassword()">
                                    <i class="bi bi-eye fs-5" id="togglePasswordIcon"></i>
                                </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="small text-muted">Secure sign-in</span>
                                <a href="{{ route('otp.request') }}" class="small text-link">Forgot password?</a>
                            </div>

                            <button type="submit" class="btn btn-login w-100">Login</button>

                            <p class="text-center mt-4 mb-0 small text-muted">
                                Don’t have an account?
                                <a href="{{ route('landlord.register') }}" class="text-link ms-1">Register here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const icon = document.getElementById('togglePasswordIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>

@endsection