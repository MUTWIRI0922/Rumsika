<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Landlord;
use App\Models\housedetails;
use App\Models\Enquiry;
use App\Models\houseviews;

use Illuminate\Http\Request;

class Dashboardcontroller extends Controller
{
    // fetch data for the dashboard
    public function index()
    {
        $totalUsers = Landlord::count();
        $totalListings = housedetails::count();
        $totalEnquiries = Enquiry::count();
        $dailyViews = houseviews::whereDate('created_at', now()->toDateString())->count();

        $recentUsers = Landlord::orderBy('created_at', 'desc')->take(5)->get();
        

        return view('Admin.Dashboard', compact('totalUsers', 'totalListings', 'totalEnquiries', 'dailyViews', 'recentUsers'
        ));
    }
}
