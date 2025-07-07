<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\housedetails;
use Illuminate\Support\Str;

class EnquiryController extends Controller
{
    //
    public function store(Request $request)
    {
        \App\Models\Enquiry::create([
            'house_id' => $request->house_id,
            'client_ip' => $request->ip(),
        ]);
        // Optionally redirect to WhatsApp after recording
        $house = \App\Models\housedetails::find($request->house_id);
        $phone = $house->landlord->phone ?? '';
        $name = $house->landlord->name ?? 'Landlord'; // Fallback to 'Landlord' if name is not set
        // Format phone as needed
        
        // If phone starts with 0, replace with 254
        if (Str::startsWith($phone, '0')) {
                $phone = '254' . substr($phone, 1);
        }
            $phone = preg_replace('/\D/', '', $phone); // Remove non-digits

        if (!$phone || !preg_match('/^\d+$/', $phone)) {
            return response()->json(['error' => 'Invalid phone number.'], 400);
        }
        $message = "Hello {$name}, I am interested in your {$house->Type} at {$house->Location}. Please provide more details. Thank you!";
        $url = "https://wa.me/{$phone}?text=" . urlencode($message);
        return response()->json(['whatsapp_url' => $url]);
    }
}
