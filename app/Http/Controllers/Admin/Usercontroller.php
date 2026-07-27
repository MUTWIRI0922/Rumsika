<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Landlord;
use App\Models\housedetails;
use App\Mail\SuspensionMail;
use App\Mail\ActivationMail;
use Illuminate\Support\Facades\Mail;

class Usercontroller extends Controller
{
    //list all users
    public function listUsers()
    {
        $users = Landlord::paginate(10);
        $users->getCollection()->transform(function ($user) {
            $user->listings_count = housedetails::where('landlord_id', $user->id)->count();
            return $user;
        });

        return view('Admin.manageusers.users-list', compact('users'));
    }
    //seaerch users
    public function searchUsers(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = Landlord::where('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('email', 'like', '%' . $searchTerm . '%')
            ->orWhere('phone', 'like', '%' . $searchTerm . '%')
            ->paginate(10);
        $users->appends(['search' => $searchTerm]); 
        return view('Admin.manageusers.users-list', compact('users'));
    }
    //show user details
    public function userDetails($id)
    {
        $user = Landlord::findOrFail($id);
        $listings_count = housedetails::where('landlord_id', $id)->count();
        return view('Admin.manageusers.viewuser', compact('user', 'listings_count'));
    }
    //show user edit form
    public function editUser($id)
    {
        $user = Landlord::findOrFail($id);
        return view('Admin.manageusers.edit-user', compact('user'));
    }
    //suspend user account
    public function suspendUser($id)
    {
        $user = Landlord::findOrFail($id);
        $reason = request()->input('reason', 'No reason provided'); // Get the reason from the request, default to 'No reason provided'
        try {
            $user->status = 'suspended';
            $user->save();
            //write an email to the user notifying them of the suspension
            Mail::to($user->email)->queue(new SuspensionMail($user, $reason));
            return redirect()->route('admin.users', $id)->with('success', 'User account suspended successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users', $id)->with('error', 'Failed to suspend user account. Please try again.');
        }
    }
    //activate user account
    public function activateUser($id)
    {
        $user = Landlord::findOrFail($id);
        try {
            $user->status = 'active';

            $user->save();
            //write an email to the user notifying them of the activation
            Mail::to($user->email)->queue(new ActivationMail($user));
            return redirect()->route('admin.users', $id)->with('success', 'User account activated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users', $id)->with('error', 'Failed to activate user account. Please try again.');
        }
    }
       
    //update user details
    public function updateUser(Request $request, $id)
    {
        $user = Landlord::findOrFail($id);
        $userdata = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:landlords,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:active,suspended',
        ],
        [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already in use.',
        ]);
        try {
            $user->update($userdata);
            return redirect()->route('admin.users', $id)->with('success', 'User details updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users', $id)->with('error', 'Failed to update user details. Please try again.');
        }
    }   
}
