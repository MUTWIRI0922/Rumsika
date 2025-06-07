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
    $url = "https://wa.me/{$phone}?text=Hello{$name},%20I%20am%20interested%20in%20your%20{$house->Type}%20at%20{$house->Location}. Please%20provide%20more%20details.%20Thank%20you!";
    return response()->json(['whatsapp_url' => $url]);
}
}
