<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kyc_controller extends Controller
{
    // kyc details submission
        public function submit(Request $request)
    {
        $request->validate([
            'id_photo' => 'required|image',
            'selfie_data' => 'required|string',
        ]);

        $idPhotoPath = $request->file('id_photo')->store('kyc/id_photos');

        $selfieData = $request->input('selfie_data');
        $selfiePath = 'kyc/selfies/' . uniqid() . '.png';
        $image = str_replace('data:image/png;base64,', '', $selfieData);
        $image = str_replace(' ', '+', $image);
        Storage::put($selfiePath, base64_decode($image));

        $publicIdPhotoPath = storage_path('app/' . $idPhotoPath);
        $publicSelfiePath = storage_path('app/' . $selfiePath);
        $scriptPath = base_path('python/face_match.py');

        $output = shell_exec("python3 $scriptPath "$publicIdPhotoPath" "$publicSelfiePath"");
        $score = floatval(trim($output));

        $kyc = KycDocument::create([
            'user_id' => auth()->id(),
            'id_photo' => $idPhotoPath,
            'selfie' => $selfiePath,
            'similarity_score' => $score,
            'status' => 'pending',
        ]);

        // Notify admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $admin->notify(new NewKycSubmitted());
        }

        return back()->with('success', 'Your KYC documents have been submitted for review.');
    }
}
