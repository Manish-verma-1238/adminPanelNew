<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\admin\State;
use App\Models\admin\Taxi;
use App\Models\admin\Price;
use App\Models\admin\LocalPrice;
use App\Models\admin\Location;
use App\Models\admin\LocationDetail;
use App\Models\Booking;
use App\Utils\CommonUtils;
use App\Mail\BookingSuccessMail;

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

            if (isset($trip) && $trip == 'local') {
                if (!$source) {
                    return redirect()->route('main')->with('not-found-error', 'Cab not available on this location.');
                }

                list($time, $distance) = explode('-', $request['packages']);
                $packages = "$time Hour - $distance Km";

                $cars = LocalPrice::with('taxi')->where('range', $request['packages'])->get();

                return view('frontend.cars')
                    ->with('cars', $cars)
                    ->with('packages', $packages)
                    ->with('source', $request['source'])
                    ->with('pickupdate', $request['pickupdate'])
                    ->with('pickuptime', $request['pickuptime'])
                    ->with('triptype', $request['triptype'])
                    ->with('phone', $request['phone'])
                    ->with('countryCode', $request['countryCode'])
                    ->with('countryName', $request['countryName']);
            }

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
                ->with('stops', $request['stops'])
                ->with('phone', $request['phone'])
                ->with('countryCode', $request['countryCode'])
                ->with('countryName', $request['countryName']);
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    private function alloweStates($stateName)
    {
        $allowedStates = State::where('show', 'yes')->get();
        $match = false;
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
                ->with('price', $price)
                ->with('phone', $request['phone'])
                ->with('countryCode', $request['countryCode'])
                ->with('countryName', $request['countryName'])
                ->with('packages', $request['packages']);
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function booking(Request $request)
    {
        try {
            $booking = new Booking();
            $bookingId = CommonUtils::BookingIdgenerate();
            $price = decrypt($request['price']);
            $phone = '+' . $request['countryCode'] . '-' . $request['phone'];
            if (isset($request['alternatePhone']) && !empty($request['alternatePhone'])) {
                $alterPhone = '+' . $request['alterCountryCode'] . '-' . $request['alternatePhone'];
            } else {
                $alterPhone = '';
            }


            if ($request['paidPercentage'] == '25') {
                $paid = $price / 4;
                $balanceAmout = $price - $price / 4;
            } elseif ($request['paidPercentage'] == '50') {
                $paid = $price / 2;
                $balanceAmout = $price - $price / 2;
            } else {
                $paid = $price;
                $balanceAmout = $price - $price;
            }

            $booking->booking_unique_id = $bookingId;
            $booking->status = 'pending';
            $booking->car_id = decrypt($request['car']) ?? '';
            $booking->trip = $request['trip'] ?? '';
            $booking->source = $request['source'] ?? '';
            $booking->stops = $request['stops'] ?? '';
            $booking->destination = $request['destination'] ?? '';
            $booking->price = round($price) ?? '';
            $booking->paid_price_percentage = $request['paidPercentage'] ?? '';
            $booking->balance_price = round($balanceAmout) ?? '';
            $booking->passengers = $request['passengers'] ?? '';
            $booking->bags = $request['bags'] ?? '';
            $booking->name = $request['name'] ?? '';
            $booking->email = $request['email'] ?? '';
            $booking->mobile = $phone ?? '';
            $booking->alternate_no = $alterPhone ?? '';
            $booking->gst_no = $request['gst'] ?? '';
            $booking->ride_date = $request['pickupdate'] ?? '';
            $booking->ride_time = $request['pickuptime'] ?? '';

            if ($booking->save()) {
                $taxi = Taxi::find(decrypt($request['car']));
                $taxiDetail = $taxi->name . ' (' . $taxi->passengers . '+1)';

                $data = [
                    'booking_unique_id' => $bookingId,
                    'car' => $taxiDetail ?? '',
                    'trip' => $request['trip'] ?? '',
                    'source' => $request['source'] ?? '',
                    'stops' => $request['stops'] ?? '',
                    'destination' => $request['destination'] ?? '',
                    'price' => round($price) ?? '',
                    'paid_price_percentage' => $request['paidPercentage'] ?? '',
                    'paid_price' => $paid,
                    'balance_price' => round($balanceAmout) ?? '',
                    'passengers' => $request['passengers'] ?? '',
                    'bags' => $request['bags'] ?? '',
                    'name' => $request['name'] ?? '',
                    'email' => $request['email'] ?? '',
                    'mobile' => $phone ?? '',
                    'alternate_no' => $alterPhone ?? '',
                    'gst_no' => $request['gst'] ?? '',
                    'ride_date' => $request['pickupdate'] ?? '',
                    'ride_time' => $request['pickuptime'] ?? ''
                ];

                Mail::to($request->input('email'))->send(new BookingSuccessMail($data));

                return redirect()->route('main')->with('booking-success', $bookingId);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            // Handle the exception, log the error, or return an error response
            return redirect::route('main')->with('error',  $e->getMessage());
        }
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function hotels()
    {
        return redirect()->route('main')->with('hotels-info', 'Hotel accommodations will be ready shortly.');
    }
}
