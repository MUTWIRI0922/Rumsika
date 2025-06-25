<?php

namespace App\Http\Controllers;
use App\Models\Houseviews;

use Illuminate\Http\Request;


class HouseviewsController extends Controller
{
    //
    public function record(Request $request)
    {
        
            $houseId = $request->id;
            $clientIp = $request->ip();

            // Check if this view already exists
            // $alreadyViewed = Houseviews::where('house_id', $houseId)
            //     ->where('client_ip', $clientIp)
            //     ->exists();

          
                Houseviews::create([
                    'house_id' => $houseId,
                    'client_ip' => $clientIp,
                ]);
            
            return redirect()->route('house.show', ['id' => $houseId]);

            
        
    }
}
