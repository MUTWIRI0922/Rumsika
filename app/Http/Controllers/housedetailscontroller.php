<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\housedetails; // Import the housedetails model
use App\Models\Houseviews; // Import the Houseviews model for tracking views
use Illuminate\Database\Eloquent\ModelNotFoundException; // Import ModelNotFoundException for error handling

use function Laravel\Prompts\select;

class housedetailscontroller extends Controller
{
    //
    public function show($id)
    {
            try {
        $select_house = \App\Models\housedetails::findOrFail($id);
    //
        $select_house = \App\Models\housedetails::with('landlord')->findOrFail($id);
        $houses = \App\Models\housedetails::all();
        // display the views for this house
        $viewsCount = Houseviews::selectRaw('house_id, COUNT(*) as view_count')
            ->whereIn('house_id', $houses->pluck('id')) // Filter views by the houses being displayed
            ->groupBy('house_id')
            ->pluck('view_count', 'house_id');
        return view('House-view', compact('select_house', 'houses', 'viewsCount')); // Return the view with the house details
        } catch (ModelNotFoundException $e) {
        // Redirect back with an error message
        return redirect('/House-view')->with('error', 'House not found!');
        }
     }
    public function viewHouse()
    {
        // Logic to retrieve and display house details
        try{
                    $houses = \App\Models\housedetails::all(); // Fetch all house details from the model
        return view('House-view', compact('houses')); // Return the view with the house details
        } catch (ModelNotFoundException $e) {
            // Redirect back with an error message
            return redirect('/House-view')->with('error', 'No houses found!');
        }
    }

    public function allHouses()
    {
        // Logic to retrieve and display house details as filtered for tenants or buyers
        $houses = \App\Models\housedetails::all(); // Fetch all house details from the model
        // Record the view for each house
        $viewsCount = Houseviews::selectRaw('house_id, COUNT(*) as view_count')
            ->whereIn('house_id', $houses->pluck('id')) // Filter views by the houses being displayed
            ->groupBy('house_id')
            ->pluck('view_count', 'house_id');

        return view('Tenant-buyer', compact('houses','viewsCount')); // Return the view with the house details
    }
    public function searchHouse()
    {
        // Logic to retrieve and display house details as filtered for tenants or buyers
        $houses = \App\Models\housedetails::all(); // Fetch all house details from the model
        return view('Tenant-buyer', compact('houses')); // Return the view with the house details
    }
    public function upload(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'rate' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image_inside' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'Image_outside' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'Amenities' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // house data array
        $data = [
        'Type' => $request->type,
        'Location' => $request->location,
        'Description' => $request->description,
        'Rate' => $request->rate,
        'landlord_id' => session('landlord_id'),
        ];
        // Handle image upload
        $data['image'] = $request->file('image')->store('houses', 'public');
            if ($request->hasFile('image_inside')) $data['image_inside'] = $request->file('image_inside')->store('houses', 'public');
            if ($request->hasFile('Image_outside')) $data['Image_outside'] = $request->file('Image_outside')->store('houses', 'public');
            if ($request->hasFile('Amenities')) $data['Amenities'] = $request->file('Amenities')->store('houses', 'public');

        
        // Create a new house record
        housedetails::create($data);
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'House uploaded successifully!');


    }
}
