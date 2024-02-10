<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\admin\State;
use App\Models\admin\Price;
use App\Models\admin\Location;
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
    {dd($request->all());
        $source = $this->alloweStates($request['source']);
        $destination = $this->alloweStates($request['destination']);

        if (!$source || !$destination) {
            return redirect()->route('main')->with('not-found-error', 'Cab not available on this location.');
        }

        //Get the location type details
        $sourceLoc = $this->findLocation($request['source']);
        $destLoc = $this->findLocation($request['destination']);

        $sorcePriority = Location::find($sourceLoc);
        $destPriority = Location::find($destLoc);

        if (empty($sorcePriority) || empty($destPriority)) {
            return redirect()->route('main')->with('not-found-error', 'Cab not available on this location.');
        }

        // min because of get the highest priority e.g between 3,2 (2 have more priority)
        $location_priority = min($sorcePriority['priority'], $destPriority['priority']);
        $location_id = Location::where('priority', $location_priority)->first();

        if (empty($location_id)) {
            return redirect()->route('main')->with('not-found-error', 'Cab not available on this location.');
        }

        $curlDetails = $this->curlDistanceCal($request['source'], $request['destination']);
        $distance = (int) $curlDetails->rows[0]->elements[0]->distance->text;
        $time = $curlDetails->rows[0]->elements[0]->duration->text;

        $cars = [];
        $price = Price::with('taxi')->where('location_id', $location_id['id'])->where('trip', $request['triptype'])->get();
        foreach ($price as $prc) {
            $range = explode('-', $prc['range']);
            if ($distance >= $range[0] && $distance <= $range[1]) {
                $cars[] = $prc;
            }
        }
        dd($price, $cars, $time);
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

    public function curlDistanceCal($from, $to)
    {
        $apiKey = "AIzaSyCcTmELSehXo7fqusqkvu4FKYtkQM_5--8"; // Replace with your Google API key

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=" . urlencode($from) . "&destinations=" . urlencode($to) . "&mode=driving&key=" . urlencode($apiKey);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($response);

        return $result; 
    }
}
