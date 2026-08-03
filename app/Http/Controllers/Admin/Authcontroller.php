<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Authcontroller extends Controller
{
    //admin login function
    public function login(Request $request)
    {

        $admin = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $admin['email'])->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        if ($user && Hash::check($admin['password'], $user->password)) {
            Auth::guard('admin')->login($user);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    //admin password change function
    public function changePassword(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'current_password' => 'required',
            'new_password' => [
                'required',
                'confirmed',
                'min:8']
        ],[
            'email.required' => 'Email is required',
            'email.email' => 'please ensure email is in the right format',
            'new_password.confirmed' => 'new password does not match the confirmed password'
        ]);

    }
    //admin profile view function
    public function showProfile()
    {
        $admin = User::find(Auth::guard('admin')->id());
        return view('Admin.settings.profile', compact('admin'));
    }
    //admin profile update function
    public function updateProfile(Request $request)
    {
        $admin = User::find(Auth::guard('admin')->id());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
        ]);

        $admin->update($validatedData);
        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    //logout function
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
