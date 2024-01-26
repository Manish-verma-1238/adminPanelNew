<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\admin\Taxi;

class TaxiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = '';
            $resultsPerPage = 10;
            $pageTitle = 'States & UT';
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
}
