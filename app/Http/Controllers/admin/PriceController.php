<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use App\Models\admin\Taxi;
use App\Models\admin\Location;
use App\Models\admin\LocationDetail;
use App\Models\admin\Price;
use Illuminate\Support\Facades\DB;

class PriceController extends Controller
{
    public function locationIndex(Request $request)
    {
        try {
            $search = '';
            $resultsPerPage = 10;
            $pageTitle = 'Price Locations';
            // $query = Location::with('details','prices.taxi')->find(2);
            $query = Location::with('details');

            if (isset($request['search']) && !empty($request['search'])) {
                $search = $request['search'];
                $query->where('name', 'like', "%$search%");
            }

            $locations = $query->orderBy('priority', 'asc')->paginate($resultsPerPage);
            return view('admin.price.location_index')
                ->with('pageTitle', $pageTitle)
                ->with('locations', $locations)
                ->with('search', $search);
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function locationCreate($id = '')
    {
        $location = [];
        $pageTitle = 'Add Locations for Price';
        if (isset($id) && !empty($id)) {
            $id = decrypt($id);
            $location = Location::with('details')->find($id);
            $pageTitle = 'Edit Location for Price';
        }

        return view('admin.price.location_add_edit')
            ->with('pageTitle', $pageTitle)
            ->with('location', $location);
    }

    public function locationSave(Request $request)
    {
        try {
            $id = $request['id'] ?? '';
            if (isset($id) && !empty($id)) {
                $id = decrypt($id);
            }
            $rules = [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('locations')->ignore($id),
                ],
                'priority' => [
                    'required',
                    'numeric',
                    Rule::unique('locations')->ignore($id),
                ],
            ];

            $messages = [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name may not be greater than 255 characters.',
                'name.unique' => 'The name has already been taken.',
                'priority.required' => 'The priority field is required.',
                'priority.numeric' => 'The priority must be a number.',
                'priority.unique' => 'The priority has already been taken.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            // Manually check if each selected location exists in the database
            $selectedLocations = $request->input('selectedLocations');

            $existsLocations = [];

            foreach ($selectedLocations as $location) {
                if (isset($id) && !empty($id)) {
                    $loc = LocationDetail::where('name', $location)->whereNot('location_id', $id)->get();
                    if (isset($loc) && count($loc) > 0) {
                        $existsLocations[] = $location;
                    }
                } elseif (LocationDetail::where('name', $location)->exists()) {
                    $existsLocations[] = $location;
                }
            }

            if (!empty($existsLocations)) {
                $existsloc = implode('| ', $existsLocations);
                $errorMessage = "The location(s) $existsloc already exist.";
                Session::flash('location_exists_error', $errorMessage);
            }

            if ($validator->fails() || !empty($existsLocations)) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //Saving the locations

            $locationObj = new Location();

            if (isset($id) && !empty($id)) {
                $locationObj = Location::find($id);
            }

            //saved and get the location id
            $locationObj->name = $request['name'];
            $locationObj->priority = $request['priority'];
            $locationObj->save();
            $locationId = $locationObj->id;

            if (isset($id) && !empty($id)) {
                LocationDetail::where('location_id', $id)->delete();
            }

            //save the cities on the particular location
            foreach ($request['selectedLocations'] as $value) {
                $locationDetailObj = new LocationDetail();
                $locationDetailObj->name = $value;
                $locationDetailObj->location_id = $locationId;
                $locationDetailObj->save();
            }

            if (isset($id) && !empty($id)) {
                return redirect()->route('location.index')->with('success', "{$locationObj->name} Location for price updated successfully.");
            }
            return redirect()->route('location.index')->with('success', "{$locationObj->name} Location for price added successfully.");
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function locationDelete($id)
    {
        try {
            $id = decrypt($id);
            if (Price::where('location_id', $id)->exists()) {
                return redirect()->route('location.index')->with('error', 'Location is used with the price.');
            }
            LocationDetail::where('location_id', $id)->delete();
            Location::find($id)->delete();
            return redirect()->route('location.index')->with('success', 'Location for price deleted successfully.');
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        try {
            $search = '';
            $resultsPerPage = 10;
            $pageTitle = 'Price';
            // $query = Location::with('details','prices.taxi')->find(2);
            $query = DB::table('prices')
                ->join('taxis', 'prices.car_id', '=', 'taxis.id')
                ->join('locations', 'prices.location_id', '=', 'locations.id')
                ->select('taxis.*', 'locations.name as location_name', 'locations.id as location_id', 'prices.trip');

            if (isset($request['search']) && !empty($request['search'])) {
                $search = $request['search'];
                $query->where(function ($query) use ($search) {
                    $query->where('taxis.name', 'like', "%$search%")
                        ->orWhere('locations.name', 'like', "%$search%");
                });
            }

            $query->distinct()->orderBy('prices.trip');
            $locations = DB::table(DB::raw("({$query->toSql()}) as sub"))
                ->mergeBindings($query) // Bind the subquery's bindings to the outer query
                ->paginate($resultsPerPage);
            return view('admin.price.index')
                ->with('pageTitle', $pageTitle)
                ->with('locations', $locations)
                ->with('search', $search);
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }
    public function create($id = '')
    {
        $taxi = Taxi::get();
        $location = Location::get();
        if (isset($taxi) && count($taxi) < 0 && isset($location) && count($location) < 0) {
            return redirect()->route('taxis.index')->with('error', "Add cab & price locations before adding price.");
        } elseif (isset($taxi) && count($taxi) < 0) {
            return redirect()->route('taxis.index')->with('error', "Add cab before adding price.");
        } elseif (isset($location) && count($location) < 0) {
            return redirect()->route('location.index')->with('error', "Add price locations before adding price.");
        }
        $pageTitle = 'Add Cabs Price';
        if (isset($id) && !empty($id)) {
            $id = decrypt($id);
            $pageTitle = 'Edit Cab Price';
        }

        return view('admin.price.add_edit')
            ->with('pageTitle', $pageTitle)
            ->with('taxi', $taxi)
            ->with('location', $location);
    }

    public function save(Request $request)
    {
        try {
            $rules = [
                'car' => 'required|numeric',
                'location' => 'required|numeric',
                'trip' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray(),
                    'input' => $request->all()
                ]);
            }

            $cabLoc = Price::where('car_id', $request['car'])->where('location_id', $request['location'])->exists();
            if ($cabLoc) {
                $responseData = [
                    'status' => 'error',
                    'message' => "Cab with this price range is already present."
                ];
                return response()->json($responseData);
            }

            $startig = [];
            foreach ($request['price'] as $price) {
                $startig[] = $price['range']['from'];
                $startig[] = $price['range']['to'];
            }

            $results = $this->findRangesForNumbers($startig, $request['car'], $request['location']);

            $existingNumbers = [];
            foreach ($results as $number => $found) {
                if ($found) {
                    $existingNumbers[] = $number;
                }
            }

            if (isset($existingNumbers) && !empty($existingNumbers)) {
                $number = implode(', ', $existingNumbers);
                $responseData = [
                    'status' => 'error',
                    'message' => "Numbers(s) {$number} is already covered in the range."
                ];
                return response()->json($responseData);
            }

            //save the price
            foreach ($request['price'] as $price) {
                $priceObj = new Price();
                $range = $price['range']['from'] . '-' . $price['range']['to'];
                $priceObj->location_id = $request['location'];
                $priceObj->car_id = $request['car'];
                $priceObj->range = $range;
                $priceObj->price = $price['price'];
                $priceObj->trip = $request['trip'];
                $priceObj->save();
            }

            $responseData = [
                'status' => 'success',
                'message' => 'Price added successfully.',
                'url' => route('price.index')
            ];
            Session::flash('success', 'Price added successfully.');
            return response()->json($responseData);
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function viewPrice(Request $request, $car_id, $location_id)
    {
        try {
            $car_id = decrypt($car_id);
            $location_id = decrypt($location_id);
            $pageTitle = "Detailed Price";
            $priceWithRange = DB::table('prices')
                ->join('taxis', 'prices.car_id', '=', 'taxis.id')
                ->join('locations', 'prices.location_id', '=', 'locations.id')
                ->select('taxis.name as car_name', 'taxis.id as car_id', 'locations.name as location_name', 'locations.id as location_id', 'prices.trip', 'prices.*')
                ->where('prices.car_id', $car_id)
                ->where('prices.location_id', $location_id)
                ->get();

            $cabWithLocation = DB::table('prices')
                ->join('taxis', 'prices.car_id', '=', 'taxis.id')
                ->join('locations', 'prices.location_id', '=', 'locations.id')
                ->select('taxis.name as car_name', 'locations.name as location_name', 'prices.trip')
                ->where('prices.car_id', $car_id)
                ->where('prices.location_id', $location_id)
                ->first();

            return view('admin.price.priceDetail')
                ->with('pageTitle', $pageTitle)
                ->with('priceWithRange', $priceWithRange)
                ->with('cabWithLocation', $cabWithLocation);
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function delete($car_id, $location_id)
    {
        try {
            $car_id = decrypt($car_id);
            $location_id = decrypt($location_id);
            if (Price::where('car_id', $car_id)->where('location_id', $location_id)->delete()) {
                return redirect()->route('price.index')->with('success', "Price deleted successfully.");
            }
            return redirect()->route('price.index')->with('error', "There is some issue, whiel deleting Price.");
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function findRangesForNumbers($numbers, $car_id, $location_id)
    {
        $ranges = Price::where('car_id', $car_id)->where('location_id', $location_id)->get(); // Fetch all ranges from the database
        $result = [];

        foreach ($numbers as $number) {
            $found = false;
            foreach ($ranges as $range) {
                $ran = explode("-", $range->range);
                if ($number >= $ran[0] && $number <= $ran[1]) {
                    $result[$number] = true; // Number falls within this range
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $result[$number] = false; // Number doesn't fall within any range
            }
        }

        return $result;
    }
}
