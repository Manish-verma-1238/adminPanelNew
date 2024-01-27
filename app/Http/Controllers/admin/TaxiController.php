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

    public function create()
    {
        $pageTitle = 'Add Cabs & Taxis';

        return view('admin.taxis.add_edit')
            ->with('pageTitle', $pageTitle);
    }

    public function save(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'similar_cars' => 'required|string|max:255',
                'passengers' => 'required|numeric|digits_between:1,2',
                'bags' => 'required|numeric|digits_between:1,2',
                'price' => 'required|numeric',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example: Allow JPEG, PNG, JPG, GIF, and a maximum file size of 2048 KB
                'about' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $taxi = new Taxi();
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

            return redirect()->route('taxis.index')->with('success', 'Cab added successfully.');
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
            if(empty($taxi)){
                return redirect()->route('taxis.index')->with('error', 'Cab details not found.');
            }
            $taxi->status = $status;
            $taxi->update();
            if($status == 'hide'){
                return redirect()->route('taxis.index')->with('success', "{$taxi->name} Cab service stopped.");
            }elseif($status == 'show'){
                return redirect()->route('taxis.index')->with('success', "{$taxi->name} Cab service started.");
            }
            return redirect()->route('taxis.index')->with('success', "{$taxi->name} Cab service started.");
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }
}
