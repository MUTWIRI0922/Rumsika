<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;
use Carbon\Carbon;

class Dashboardcontroller extends Controller
{
    //stats display
    public function index(Request $request)
    {
        $landlordId     = session('landlord_id');
        $houses = \App\Models\housedetails::where('landlord_id', $landlordId)->get();
        $housesCount    = \App\Models\housedetails::where('landlord_id', $landlordId)->count();
        $landlord = \App\Models\Landlord::find($landlordId);
        $enquiriesCount = \App\Models\Enquiry::whereIn(
            'house_id',
            \App\Models\housedetails::where('landlord_id', $landlordId)->pluck('id')
        )->count();
         // Example: Enquiries per month for the current year
         $houseIds = \App\Models\housedetails::where('landlord_id', $landlordId)->pluck('id');
        $enquiriesPerMonth = Enquiry::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereIn('house_id', $houseIds)
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Fill missing months with 0
        $enquiriesData = [];
        for ($m = 1; $m <= 12; $m++) {
            $enquiriesData[] = $enquiriesPerMonth[$m] ?? 0;
        }
        return view('Dashboard', compact('housesCount', 'enquiriesCount', 'landlord','houses', 'enquiriesData'));
    }
}
