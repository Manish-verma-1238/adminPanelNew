<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\State;

class StateController extends Controller
{
    public function index()
    {
        $pageTitle = 'States & UT';
        $states = State::get();
        return view('admin.state.index')
            ->with('pageTitle', $pageTitle)
            ->with('states', $states);
    }

    public function update(Request $request){
        $states = $request['states'];
        if(isset($states) && !empty($states)){
            State::query()->update(['show' => 'no']);
            foreach($states as $state){
                State::where('name', $state)->update(['show' => 'yes']);
            }

            return redirect()->route('states.index')->with('success', 'Location updated successfully.');
        }
    }
}
