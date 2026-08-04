<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\houseviews;
use App\Models\housedetails;
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
        //views for all houses owned by the landlord
        $viewsCount= \App\Models\houseviews::whereIn(
            'house_id',\App\Models\housedetails::where('landlord_id',$landlordId)->pluck('id')
        )->count();
        //views for specific houses
  
         //  Enquiries per month for the current year
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
        //views chart data
        $viewsPerMonth = houseviews::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereIn('house_id', $houseIds)
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Fill missing months with 0
        $viewsData = [];
        for ($m = 1; $m <= 12; $m++) {
            $viewsData[] = $viewsPerMonth[$m] ?? 0;
        }
        //views capture
        return view('landlord.dashboard', compact('housesCount', 'enquiriesCount','viewsCount','landlord','houses', 'enquiriesData', 'viewsData'));
    }
    public function landlordHouses(Request $request)
    {
        $landlordId = session('landlord_id');
        $houses = \App\Models\housedetails::where('landlord_id', $landlordId)->get();
        $HviewsCount = Houseviews::selectRaw('house_id, COUNT(*) as view_count')
            ->whereIn('house_id', $houses->pluck('id')) // Filter views by the houses being displayed
            ->groupBy('house_id')
            ->pluck('view_count', 'house_id'); 
        return view('landlord.houseslist', compact('houses', 'HviewsCount'));
    }
    public function showHouseDetails($id)
    {
        $landlordId = session('landlord_id');
        $house = \App\Models\housedetails::where('id', $id)->where('landlord_id', $landlordId)->firstOrFail();
        $HviewsCount = houseviews::selectRaw('house_id, COUNT(*) as view_count')
            ->where('house_id', $house->id)
            ->groupBy('house_id')
            ->pluck('view_count', 'house_id');

        return view('landlord.viewhouse', compact('house', 'HviewsCount'));
    }
    public function edit($id)
    {
        $landlordId = session('landlord_id');
        $house = \App\Models\housedetails::where('id', $id)->where('landlord_id', $landlordId)->firstOrFail();
        return view('landlord.edithouse', compact('house'));
    }
    //update a house in the system
    public function houseupdate(Request $request, $id)
    {
        $house = housedetails::findOrFail($id);
        $updatedhouse = $validated = $request->validate([
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'rate' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'image_inside' => 'nullable|image|max:2048',
            'Image_outside' => 'nullable|image|max:2048',
            'Amenities' => 'nullable|image|max:2048',
            'available_units' => 'nullable|integer|min:0',
        ],[
            'type.required' => 'The type field is required.',
            'location.required' => 'The location field is required.',
            'description.required' => 'The description field is required.',
            'rate.required' => 'The rate field is required.',
            'image.image' => 'The image must be a valid image file.',
            'image_inside.image' => 'The inside image must be a valid image file.',
            'Image_outside.image' => 'The outside image must be a valid image file.',
            'Amenities.image' => 'The amenities image must be a valid image file.',
            'available_units.integer' => 'The available units must be an integer.',
            'available_units.min' => 'The available units must be a positive integer.',
        ]);



        // Handle image upload if present
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('houses', 'public');
            $updatedhouse['image'] = $path;
        }
         if ($request->hasFile('image_inside')) {
        $path = $request->file('image_inside')->store('houses', 'public');
        $updatedhouse['image_inside'] = $path;
        }
        if ($request->hasFile('Image_outside')) {
            $path = $request->file('Image_outside')->store('houses', 'public');
            $updatedhouse['Image_outside'] = $path;
        }
        if ($request->hasFile('Amenities')) {
            $path = $request->file('Amenities')->store('houses', 'public');
            $updatedhouse['Amenities'] = $path;
        }
        $house->update($updatedhouse);

        return redirect()->route('landlord.houses')->with('success', 'House updated successfully!');
    }
    //delete a house from the system
    public function housedelete($id)
    {
        $house = \App\Models\housedetails::findOrFail($id);

        // Optional: check if the logged-in landlord owns this house
        if ($house->landlord_id != session('landlord_id')) {
            return back()->with('error', 'Unauthorized action.');
        }

        $house->delete();

        return back()->with('success', 'House deleted successfully!');
    }    

}
