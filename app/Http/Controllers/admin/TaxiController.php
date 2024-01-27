<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Taxi;

class TaxiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = '';
            $resultsPerPage = 10;
            $pageTitle = 'Cabs & Taxis';
            $query = Taxi::query();

            if (isset($request['search']) && !empty($request['search'])) {
                $search = $request['search'];
                $query->where('name', 'like', "%$search%");
            }

            $taxis = $query->paginate($resultsPerPage);

            return view('admin.taxis.index')
                ->with('pageTitle', $pageTitle)
                ->with('taxis', $taxis)
                ->with('search', $search);
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function create($id = '')
    {
        $taxi = [];
        $pageTitle = 'Add Cabs & Taxis';
        if (isset($id) && !empty($id)) {
            $id = decrypt($id);
            $pageTitle = 'Edit Cabs & Taxis';
            $taxi = Taxi::find($id)->first();
        }

        return view('admin.taxis.add_edit')
            ->with('pageTitle', $pageTitle)
            ->with('taxi', $taxi);
    }

    public function save(Request $request)
    {
        try {
            $id = $request['id'] ?? '';
            $rules = [
                'name' => 'required|string|max:255',
                'similar_cars' => 'required|string|max:255',
                'passengers' => 'required|numeric|digits_between:1,2',
                'bags' => 'required|numeric|digits_between:1,2',
                'price' => 'required|numeric',
                'about' => 'nullable|string',
            ];

            if (isset($id) && !empty($id)) {
                $rules['image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
            } else {
                $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048'; // Example: Allow JPEG, PNG, JPG, GIF, and a maximum file size of 2048 KB
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $taxi = new Taxi();

            if (isset($id) && !empty($id)) {
                $id = decrypt($id);
                $taxi = Taxi::find($id);
            }
            $taxi->name = $request['name'];
            $taxi->similar_cars = $request['similar_cars'];
            $taxi->passengers = $request['passengers'];
            $taxi->bags = $request['bags'];
            $taxi->price = $request['price'];
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $extension = $file->getclientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('assets/admin/assets/img/upload/taxis', $filename);
                $taxi->image = $filename;
            }
            $taxi->other_details = $request['about'];
            $taxi->save();

            if (isset($id) && !empty($id)) {
                return redirect()->route('taxis.index')->with('success', "{$taxi->name} Cab updated successfully.");
            }
            return redirect()->route('taxis.index')->with('success', "{$taxi->name} Cab added successfully.");
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function status($id, $status)
    {
        try {
            $id = decrypt($id);
            $status = decrypt($status);
            $taxi = Taxi::find($id);
            if (empty($taxi)) {
                return redirect()->route('taxis.index')->with('error', 'Cab details not found.');
            }
            $taxi->status = $status;
            if ($taxi->update() && $status == 'hide') {
                return redirect()->route('taxis.index')->with('success', "{$taxi->name} Cab service stopped.");
            } elseif ($taxi->update() && $status == 'show') {
                return redirect()->route('taxis.index')->with('success', "{$taxi->name} Cab service started.");
            }
            return redirect()->route('taxis.index')->with('error', "Cab details not found.");
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function delete($id){
        try{
            $id = decrypt($id);
            Taxi::find($id)->delete();
            return redirect()->route('taxis.index')->with('success', 'Cab deleted successfully.');
        }catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }
}
