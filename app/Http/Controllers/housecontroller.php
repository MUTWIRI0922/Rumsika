<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\housedetails;

class housecontroller extends Controller
{
    //
    public function update(Request $request, $id)
    {
        $house = housedetails::findOrFail($id);
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'rate' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'image_inside' => 'nullable|image|max:2048',
            'Image_outside' => 'nullable|image|max:2048',
            'Amenities' => 'nullable|image|max:2048',
        ]);

        $house->Type = $validated['type'];
        $house->Location = $validated['location'];
        $house->Description = $validated['description'];
        $house->Rate = $validated['rate'];

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('houses', 'public');
            $house->image = $path;
        }
         if ($request->hasFile('image_inside')) {
        $path = $request->file('image_inside')->store('houses', 'public');
        $house->image_inside = $path;
        }
        if ($request->hasFile('Image_outside')) {
            $path = $request->file('Image_outside')->store('houses', 'public');
            $house->Image_outside = $path;
        }
        if ($request->hasFile('Amenities')) {
            $path = $request->file('Amenities')->store('houses', 'public');
            $house->Amenities = $path;
        }
        $house->save();

        return redirect()->route('dashboard', ['section' => 'my-houses'])->with('success', 'House updated successfully!');
    }
}
