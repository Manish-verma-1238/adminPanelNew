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
            $query = Location::query();

            if (isset($request['search']) && !empty($request['search'])) {
                $search = $request['search'];
                $query->where('name', 'like', "%$search%");
            }

            $locations = $query->paginate($resultsPerPage);
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
        if (isset($taxi) && count($taxi) < 0) {
            return redirect()->route('taxis.index')->with('error', "Add cab before adding price.");
        }
        $pageTitle = 'Add Cabs Price';
        if (isset($id) && !empty($id)) {
            $id = decrypt($id);
            $pageTitle = 'Edit Cab Price';
        }

        return view('admin.price.add_edit')
            ->with('pageTitle', $pageTitle)
            ->with('taxi', $taxi);
    }

    public function save(Request $request)
    {
        try {
            $locationObj = new Location();

            //saved and get the location id
            $locationObj->name = $request['price_name'];
            $locationObj->priority = $request['priority'];
            $locationObj->save();
            $locationId = $locationObj->id;

            //save the cities on the particular location
            foreach ($request['selectedLocations'] as $value) {
                $locationDetailObj = new LocationDetail();
                $locationDetailObj->name = $value;
                $locationDetailObj->location_id = $locationId;
                $locationDetailObj->save();
            }

            //save the price
            foreach ($request['price'] as $price) {
                $priceObj = new Price();
                $range = $price['range']['from'] . '-' . $price['range']['to'];
                $priceObj->location_id = $locationId;
                $priceObj->car_id = $request['car'];
                $priceObj->range = $range;
                $priceObj->price = $price['price'];
                $priceObj->trip = $request['trip'];
                $priceObj->save();
            }

            return redirect()->route('taxis.index')->with('success', "{$locationObj->name} price with location added successfully.");
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }
}
