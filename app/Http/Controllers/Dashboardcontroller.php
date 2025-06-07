<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\housedetails;
use App\Http\Controllers\RegistrationController;
use App\Models\Landlord;

class Dashboardcontroller extends Controller
{
    //stats display
    public function index(Request $request)
        {
            $landlordId = session('landlord_id');
            $housesCount = \App\Models\housedetails::where('landlord_id', $landlordId)->count();
            // Add more stats as needed
            return view('Dashboard', compact('housesCount'));
        }
}
