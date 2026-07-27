@extends('layouts.landlord')
@section('title', 'KYC verification')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">KYC Verification</h3>
        <p class="text-muted mb-0">Complete identity verification to unlock full account features.</p>
    </div>
</div>
<div class="modal fade" id="kycVerifyModal" tabindex="-1" aria-labelledby="kycVerifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="" id="kycVerifyForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kycVerifyModalLabel">KYC Verification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="id_photo">Upload ID Document:</label>
                    <input type="file" name="id_photo" required><br><br>

                    <!-- Live feed & working canvas (canvas stays hidden) -->
                    <video id="video" width="250px" autoplay playsinline style="display:none;"></video>
                    <canvas id="canvas" width="300" height="200" style="display:none;"></canvas>
                    <!-- CAPTURE BUTTON -->
                    <br><br>
                    <button type="button" class="btn btn-danger" id="captureBtn"> Capture Selfie</button><br><br>
                    <!-- Hidden base64 + user preview -->
                    <input type="hidden" name="selfie_data" id="selfie_data">
                    <img id="preview" style="width: 250px; display:none; border:1px solid #ccc;" />
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancelBtn" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Verify</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection