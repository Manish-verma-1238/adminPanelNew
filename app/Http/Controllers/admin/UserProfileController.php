<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\admin\UserProfile;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::User();
        $pageTitle = 'User Profile';
        return view('admin.user-profile.editProfile')
            ->with('pageTitle', $pageTitle)
            ->with('user', $user);
    }

    public function save(Request $request)
    {
        try {
            $customMessages = [
                'name.required' => 'The name field is required.',
                'brand-name.required' => 'The brand name field is required.',
                'phone.required' => 'The phone name field is required.',
                'phone.min' => 'The phone number must be at least :min characters long.',
            ];

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'brand-name' => 'required',
                'phone' => 'required|min:10',
            ], $customMessages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::find(Auth()->user()->id);
            if (isset($user) && !empty($user) && isset($request['name']) && !empty($request['name'])) {
                $user->name = $request['name'];
                $user->update();

                //Update the users profile
                $userProfile = new UserProfile();
                $userProfile = $userProfile->where('user_id', Auth()->user()->id)->first();
                $userProfile->phone = $request['phone'];
                $userProfile->panel_name = $request['brand-name'];
                if ($request->hasfile('brand-logo')) {
                    $file = $request->file('brand-logo');
                    $extension = $file->getclientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('assets/admin/assets/img/upload/user-profile', $filename);
                    $userProfile->panel_logo = $filename;
                }
                $userProfile->about = $request['about'];
                $userProfile->update();

                return redirect()->back()->with('success', 'User Profile updated successfully.');
            }

            return redirect()->back()->with('error', 'User not found.');
        } catch (\Throwable $e) {
            // Handle the exception, log the error, or return an error response
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
