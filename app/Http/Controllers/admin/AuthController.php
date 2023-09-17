<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistration;
use App\Mail\ForgotPassword;

class AuthController extends Controller
{
    /* login view */
    public function loginView(){
        $pageTitle = 'Login';
        return view('admin.auth.login')
                ->with('pageTitle', $pageTitle);
    }

    /* login Action */
    public function login(Request $request){
        try{

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return redirect()->back()->withErrors([
                    'email' => 'The email does not exist. Please Register yourself.',
                ])->withInput();
            }

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials, $request->filled('remember'))) {
                return redirect()->intended('/dashboard');
            }

            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'password' => 'Your Password is not correct.',
            ]);

        }catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    /* registration view */ 
    public function registration(){
        $pageTitle = 'Register';
        return view('admin.auth.registration')
                ->with('pageTitle', $pageTitle);
    }

    /* Registration action */
    public function register(Request $request){
        try {
            $customMessages = [
                'name.required' => 'The name field is required.',
                'email.required' => 'The email field is required.',
                'email.email' => 'Please provide a valid email address.',
                'password.required' => 'The password field is required.',
                'password.min' => 'The password must be at least :min characters long.',
                'password.confirmed' => 'The confirmation password does not match with password.',
            ];

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ], $customMessages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // If validation passes, create a new user
            $user = new User([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            $user->save();

            $emailData = [
                'name' => $request->input('name'),
            ];
            Mail::to($request->input('email'))->send(new UserRegistration($emailData));

            return redirect()->route('view.login')->with('success', 'Registered Successfully, Login here..');

        }catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    /* Forgot Password */
    public function forgotPassword(){
        $pageTitle = 'Forgot Password';
        return view('admin.auth.forgot')
                ->with('pageTitle', $pageTitle);
    }

    /* forgot action */
    public function forgot(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return redirect()->back()->withErrors([
                    'email' => 'The email does not exist. Please check your email or register yourself.',
                ])->withInput();
            }

            Mail::to($request->input('email'))->send(new ForgotPassword($user));

            return redirect()->back()->with('success', 'Forgot Password link sent on your mail.');

        }catch (\Exception $e) {
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function resetPassword($id = null){
        $pageTitle = 'Reset Password';
        return view('admin.auth.resetPassword')
                ->with('pageTitle', $pageTitle)
                ->with('id', $id);
    }

    public function reset(Request $request){
        try {
            $customMessages = [
                'password.required' => 'The password field is required.',
                'password.min' => 'The password must be at least :min characters long.',
                'password.confirmed' => 'The confirmation password does not match with password.',
            ];

            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:8|confirmed',
            ], $customMessages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $id = decrypt($request['id']);
            $user = User::find($id);
            $user->password = Hash::make($request['password']);
            $user->update();

            return redirect('login')->with('success', 'Your Password is updated. Login Here.');

        }catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }    
    }

    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(){
        // $user = Socialite::driver('google')->user();
        // $data = User::where('email', $user->email)->first();

        // if(is_null($data)){
        //     $users['name'] = $user->nickname;
        //     $users['email'] = $user->email;
        //     $data = User::Create($users);
        // }

        // Auth::Login($data);
        // return redirect('dashboard');
    }

    public function dashboard(Request $request){
        $pageTitle = 'Dashboard';
        return view('admin.dashboard.dashboard')
                ->with('pageTitle', $pageTitle);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login')->with('success', 'Logout Successfully.');
    }

}
