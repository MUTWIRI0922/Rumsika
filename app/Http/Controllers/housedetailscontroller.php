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
}
