<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboardcontroller extends Controller
{
    //stats display
    public function index(Request $request)
    {
        $landlordId     = session('landlord_id');
        $housesCount    = \App\Models\housedetails::where('landlord_id', $landlordId)->count();
        $enquiriesCount = \App\Models\Enquiry::whereIn(
            'house_id',
            \App\Models\housedetails::where('landlord_id', $landlordId)->pluck('id')
        )->count();
        return view('Dashboard', compact('housesCount', 'enquiriesCount'));
    }
}
