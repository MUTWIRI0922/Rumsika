<?php
namespace App\Http\Controllers;

use App\Models\Landlord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    // registration controller
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:landlords,email',
            'phone'    => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        Landlord::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', 'Registration successful!');
    }
    //login function
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
    //logout function
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/Landlord-login');
    }
    //otp-sending function
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $landlord = Landlord::where('email', $request->email)->first();
        if (! $landlord) {
            return back()->withErrors(['email' => 'This email is not registered.']);
        }
        $otp = rand(100000, 999999);

        // Store OTP and expiry in session
        session([
            'otp'            => $otp,
            'otp_email'      => $request->email,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP via email
        Mail::raw("Your OTP for password reset is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Rumsika OTP Code');
        });

        return redirect('/otp/verify')->with('success', 'OTP sent to your email.');
    }
    //otp-verification
    public function verifyOtp(Request $request)
    {
        $request->validate(['email' => 'required|email', 'otp' => 'required']);

        if (
            session('otp') == $request->otp &&
            session('otp_email') == $request->email &&
            session('otp_expires_at') && now()->lt(session('otp_expires_at'))
        ) {
            // OTP is valid
            // Optionally clear OTP from session
            session()->forget(['otp', 'otp_expires_at']);

            // Proceed (e.g., show password reset form)
            return redirect('/password-reset')->with('success', 'OTP verified. You may reset your password.');
        } else {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }
    }
    // password reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        // Only allow the email that received the OTP
        if ($request->email !== session('otp_email')) {
            return back()->withErrors(['email' => 'Invalid email for password reset.']);
        }

        $landlord = Landlord::where('email', $request->email)->first();
        if (! $landlord) {
            return back()->withErrors(['email' => 'No account found for this email.']);
        }

        $landlord->password = bcrypt($request->password);
        $landlord->save();

        // Optionally clear OTP session
        // session()->forget(['otp', 'otp_expires_at']);

        return redirect('/Landlord-login')->with('success', 'Password reset successful! You can now log in.');
    }
    //profile update function
    public function updateProfile(Request $request)
    {
        $landlord = Landlord::findOrFail(session('landlord_id'));

        $data = $request->only(['name', 'email', 'phone']);

        if ($request->hasFile('profile_picture')) {
            $file                    = $request->file('profile_picture');
            $path                    = $file->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        $landlord->update($data);

        return redirect()->route('dashboard', ['section' => 'profile'])->with('success', 'Profile updated successfully!');
    }
    // change password function
    public function changePassword(Request $request)
    {
        $request->validate([
            'current' => 'required',
            'new'     => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],
        ], [
            'new.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        $landlord = Landlord::findOrFail(session('landlord_id'));

        if (! Hash::check($request->current, $landlord->password)) {
            return back()->withErrors(['current' => 'Current password is incorrect.']);
        }

        $landlord->password = bcrypt($request->new);
        $landlord->save();

        return back()->with('success', 'Password changed successfully!');
    }
}
