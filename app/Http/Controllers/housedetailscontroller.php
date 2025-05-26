<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\housedetails; // Import the housedetails model

class housedetailscontroller extends Controller
{
    //
    
    public function findHouse()
    {
        // Logic to retrieve and display house details
        $houses = \App\Models\housedetails::all(); // Fetch all house details from the model
        return view('House-view', compact('houses')); // Return the view with the house details
    }
}
