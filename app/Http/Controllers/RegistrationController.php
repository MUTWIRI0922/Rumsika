<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Landlord;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:landlords,email',
            'phone' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        Landlord::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', 'Registration successful!');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $landlord = \App\Models\Landlord::where('email', $credentials['email'])->first();

        if ($landlord && Hash::check($credentials['password'], $landlord->password)) {
            // Store landlord info in session
            session(['landlord_id' => $landlord->id, 'landlord_name' => $landlord->name]);
            return redirect('/Dashboard'); // Change to your intended page
        } else {
            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }
    }
}
