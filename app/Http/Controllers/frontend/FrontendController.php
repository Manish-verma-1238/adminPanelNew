<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\admin\State;
use App\Models\admin\Taxi;
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
    {
        try {
            $trip = $request['triptype'];
            $source = $this->alloweStates($request['source']);
            $destination = $this->alloweStates($request['destination']);

            // check the states is available in case of round-trip
            if (isset($trip) && $trip == 'round-trip') {
                $stops = $request['stops'];
                array_unshift($stops, $request['source']);
                $stops[] = $request['destination'];
                foreach ($stops as $stop) {
                    if (!$this->alloweStates($stop)) {
                        return redirect()->route('main')->with('not-found-error', 'Cab not available on this location.');
                    }
                }
            }

            if (!$source || !$destination) {
                return redirect()->route('main')->with('not-found-error', 'Cab not available on this location.');
            }

            //Get the location type details
            if (isset($trip) && $trip == 'round-trip') {
                $roundWayPriority = [];
                foreach ($stops as $stop) {
                    $loc = $this->findLocation($stop);
                    $roundWayPriority[] = Location::where('id', $loc)->pluck('priority')->first();
                }

                $location_priority = min($roundWayPriority);
            } else {
                $sourceLoc = $this->findLocation($request['source']);
                $destLoc = $this->findLocation($request['destination']);

                $sorcePriority = Location::find($sourceLoc);
                $destPriority = Location::find($destLoc);

                if (empty($sorcePriority) || empty($destPriority)) {
                    return redirect()->route('main')->with('not-found-error', 'Cab not available on this location.');
                }

                // min because of get the highest priority e.g between 3,2 (2 have more priority)
                $location_priority = min($sorcePriority['priority'], $destPriority['priority']);
            }

            $location_id = Location::where('priority', $location_priority)->first();

            if (empty($location_id)) {
                return redirect()->route('main')->with('not-found-error', 'Cab not available on this location.');
            }

            // in case of round trip rate calculate
            if (isset($trip) && $trip == 'round-trip') {
                $distance = $this->getTotalDistance($stops);
                $time = '';
            } else { // in case of one way rate calculate
                $stops = [];
                $curlDetails = $this->curlDistanceCal($request['source'], $request['destination']);
                $distance = (int) $curlDetails->rows[0]->elements[0]->distance->text;
                $time = $curlDetails->rows[0]->elements[0]->duration->text;
            }

            $cars = [];
            $price = Price::with('taxi')->where('location_id', $location_id['id'])->where('trip', $request['triptype'])->get();
            foreach ($price as $prc) {
                $range = explode('-', $prc['range']);
                if ($distance >= $range[0] && $distance <= $range[1]) {
                    $cars[] = $prc;
                }
            }

            if (empty($cars)) {
                return redirect()->route('main')->with('not-found-error', 'Cab not available on this location.');
            }

            return view('frontend.cars')
                ->with('cars', $cars)
                ->with('time', $time)
                ->with('source', $request['source'])
                ->with('destination', $request['destination'])
                ->with('distance', $distance)
                ->with('pickupdate', $request['pickupdate'])
                ->with('pickuptime', $request['pickuptime'])
                ->with('triptype', $request['triptype'])
                ->with('stops', $request['stops']);
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
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
        $apiKey = env('GOOGLE_MAPS_API_KEY'); // Replace with your Google API key

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=" . urlencode($from) . "&destinations=" . urlencode($to) . "&mode=driving&key=" . urlencode($apiKey);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($response);

        return $result;
    }

    public function getTotalDistance($locations)
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        $totalDistance = 0;

        for ($i = 0; $i < count($locations) - 1; $i++) {
            $origin = urlencode($locations[$i]);
            $destination = urlencode($locations[$i + 1]);

            $response = $this->makeRequest($origin, $destination, $apiKey);

            if (!empty($response['rows'][0]['elements'][0]['distance']['value'])) {
                $totalDistance += $response['rows'][0]['elements'][0]['distance']['value'];
            }
        }

        // Convert total distance to kilometers
        $totalDistanceInKm = $totalDistance / 1000;

        return $totalDistanceInKm;
    }

    protected function makeRequest($origin, $destination, $apiKey)
    {
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&key=$apiKey";

        $response = Http::get($url);

        return $response->json();
    }

    public function customerDetails(Request $request)
    {
        try {
            $car = Taxi::find(decrypt($request['car']));
            $price = decrypt($request['price']);
            return view('frontend.customerDetails')
                ->with('source', $request['source'])
                ->with('destination', $request['destinations'])
                ->with('pickupdate', $request['pickupdate'])
                ->with('pickuptime', $request['pickuptime'])
                ->with('time', $request['time'])
                ->with('triptype', $request['triptype'])
                ->with('stops', $request['stops'])
                ->with('car', $car)
                ->with('price', $price);
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function booking(Request $request)
    {
        dd($request->all());
    }
}
