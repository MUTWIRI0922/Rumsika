@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>KYC Request Details</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">User: {{ $kycRequest->user->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $kycRequest->user->email }}</p>
            <p class="card-text"><strong>Date:</strong> {{ $kycRequest->created_at->format('Y-m-d') }}</p>
            <p class="card-text"><strong>ID Photo:</strong></p>
            <img src="{{ asset('storage/' . $kycRequest->id_photo) }}" alt="ID Photo" style="width: 200px; height: auto;">
            <p class="card-text mt-3"><strong>Selfie:</strong></p>
            <img src="{{ asset('storage/' . $kycRequest->selfie) }}" alt="Selfie" style="width: 200px; height: auto;">
            <!-- <p class="card-text mt-3"><strong>Score:</strong> {{ $kycRequest->score }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $kycRequest->status }}</p> -->
            <p>Payment Status: {{ $kycRequest->payment_status }}</p>
            <form method="POST" action="{{ route('admin.kyc.request.approve', $kycRequest->id) }}">
                @csrf
                @method('PUT')
                <button name="action" value="approve" class="btn btn-success">Approve</button>
                <button name="action" value="reject" class="btn btn-danger">Reject</button>
            </form>
        </div>
</div>
@endsection
