@extends('layouts.admin')
@section('title', 'Profile Settings')
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Profile Settings</h3>
            <p class="text-muted mb-0">Update your profile information.</p>
        </div>
    </div>
    <form method="POST" action="" class="mb-4">
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
        <div class="form-outline col-md-6 mb-4">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', auth()->user()->username) }}" placeholder="Enter your name">
        </div>

        <div class="form-outline col-md-6 mb-4">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Enter your email">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
@endsection