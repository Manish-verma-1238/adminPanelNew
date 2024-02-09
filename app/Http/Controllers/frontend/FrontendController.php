<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\admin\State;
use App\Models\admin\Price;
use App\Models\admin\LocationDetail;

class FrontendController extends Controller
{
    public function index()
    {
        try {
            return view('frontend.index');
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function cabs(Request $request)
    {
        $source = $this->alloweStates($request['source']);
        $destination = $this->alloweStates($request['destination']);

        if (!$source || !$destination) {
            return redirect()->route('main')->with('not-found-error', 'Cab not available on this location.');
        }

        //Get the location type details
        $sourceLoc = $this->findLocation($request['source']);
        $destLoc = $this->findLocation($request['destination']);
        $location_id = max($sourceLoc, $destLoc);
        $distance = 13;

        $cars = [];
        $price = Price::with('taxi')->where('location_id', $location_id)->where('trip', $request['triptype'])->get();
        foreach ($price as $prc) {
            $range = explode('-', $prc['range']);
            if ($distance >= $range[0] && $distance <= $range[1]) {
                $cars[] = $prc;
            }
        }
        dd($price, $cars);
    }

    private function alloweStates($stateName)
    {
        $allowedStates = State::where('show', 'yes')->get();

        foreach ($allowedStates as $state) {
            if (stristr(strtolower($stateName), strtolower($state['name']))) {
                $match = true;
                break;
            } else {
                $match = false;
            }
        }
        return $match;
    }

    private function findLocation($locationName)
    {
        $allLocations = LocationDetail::all();
        foreach ($allLocations as $location) {
            $stateName = str_ireplace(', India', '', $location['name']);
            if (strpos(strtolower($locationName), strtolower($stateName)) !== false) {
                $location_id = $location['location_id'];
                break;
            } else {
                $location_id = 0;
            }
        }
        return $location_id;
    }
}
