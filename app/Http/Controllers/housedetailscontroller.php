<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\housedetails; // Import the housedetails model
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
        return view('House-view', compact('select_house', 'houses'));
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
    public function filterHouse()
    {
        // Logic to retrieve and display house details as filtered for tenants or buyers
        $houses = \App\Models\housedetails::all(); // Fetch all house details from the model
        return view('Tenant-buyer', compact('houses')); // Return the view with the house details
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
        ]);

        $imagePath = $request->file('image')->store('houses', 'public');

        housedetails::create([
            'Type' => $request->type,
            'Location' => $request->location,
            'Description' => $request->description,
            'Rate' => $request->rate,
            'image' => $imagePath,
            'landlord_id' => session('landlord_id'), // Automatically set landlord_id from session
        ]);

        return redirect()->back()->with('success', 'House uploaded successfully!');
    }
}
