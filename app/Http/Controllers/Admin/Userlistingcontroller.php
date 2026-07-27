<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Userlistingcontroller extends Controller
{
    //view all user listings
    public function userListings($id)
    {
        $user = \App\Models\Landlord::findOrFail($id);
        $listings = \App\Models\housedetails::where('landlord_id', $id)->get();
        return view('Admin.manageusers.user-listings', compact('user', 'listings'));
    }   
    //view single user listing details
    public function userListingDetails($id, $listingId)
    {
        $user = \App\Models\Landlord::findOrFail($id);
        $listing = \App\Models\housedetails::where('landlord_id', $id)->findOrFail($listingId);
        return view('Admin.manageusers.listing-view', compact('user', 'listing'));
    }
    //show edit form for user listing
    public function editUserListing($id, $listingId)
    {
        $user = \App\Models\Landlord::findOrFail($id);
        $listing = \App\Models\housedetails::where('landlord_id', $id)->findOrFail($listingId);
        return view('Admin.manageusers.listing-edit', compact('user', 'listing'));
    }
    //update user listing details
    public function updateUserListing(Request $request, $id, $listingId)
    {
        $listing = \App\Models\housedetails::where('landlord_id', $id)->findOrFail($listingId);
        $listingData = $request->validate([
            'Type' => 'required|string|max:255',
            'Location' => 'required|string|max:255',
            'Rate' => 'required|numeric',
            'available_units' => 'required|integer|min:0',
            'Description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_inside' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Image_outside' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Amenities' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'Type.required' => 'The Type field is required.',
            'Location.required' => 'The Location field is required.',
            'Rate.required' => 'The Rate field is required.',
            'Rate.numeric' => 'The Rate must be a number.',
            'available_units.required' => 'The number of available units is required.',
            'available_units.integer' => 'The number of available units must be a whole number.',
            'available_units.min' => 'The number of available units cannot be negative.',
            'Description.string' => 'The Description must be a string.',
            'image.image' => 'The Image must be an image file.',
            'image_inside.image' => 'The Inside Image must be an image file.',
            'Image_outside.image' => 'The Outside Image must be an image file.',
            'Amenities.image' => 'The Amenities Image must be an image file.',
            'image.max' => 'The Image may not be greater than 2MB.',
            'image_inside.max' => 'The Inside Image may not be greater than 2MB.',
            'Image_outside.max' => 'The Outside Image may not be greater than 2MB.',
            'Amenities.max' => 'The Amenities Image may not be greater than 2MB.',
        ]); 
        try {
            // Handle image upload if present
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('houses', 'public');
                $listingData['image'] = $path;
            }
            if ($request->hasFile('image_inside')) {
                $path = $request->file('image_inside')->store('houses', 'public');
                $listingData['image_inside'] = $path;
            }
            if ($request->hasFile('Image_outside')) {
                $path = $request->file('Image_outside')->store('houses', 'public');
                $listingData['Image_outside'] = $path;
            }
            if ($request->hasFile('Amenities')) {
                $path = $request->file('Amenities')->store('houses', 'public');
                $listingData['Amenities'] = $path;
            }
            $listing->update($listingData);
            return redirect()->route('admin.user.listings', $id)->with('success', 'Listing updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update. Please try again.']);
        }


    }

}
