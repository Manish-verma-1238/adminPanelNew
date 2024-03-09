<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Api\Vendor;

class VendorController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:vendors',
            'phone' => 'required|unique:vendors',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
                'code' => 422
            ];
            return response()->json($response, 400);
        }

        //Referal code
        $number = rand(0, 9999);
        $numberString = str_pad($number, 4, '0', STR_PAD_LEFT);
        $referralCode = 'ZIPZAP' . $numberString;

        // Check if the generated code already exists in the database
        while (Vendor::where('self_referal_code', $referralCode)->exists()) {
            $number = rand(0, 9999);
            $numberString = str_pad($number, 4, '0', STR_PAD_LEFT);
            $referralCode = 'ZIPZAP' . $numberString;
        }

        $vendor = new Vendor([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'otp' => '1234',
            'self_referal_code' => $referralCode,
            'refered_by' => $request->refered_by,
            'device_type' => '0'
        ]);
        $vendor->save();

        // $success['token'] = $user->createToken('MyApp')->plainTextToken;

        $vendorDetail = [
            'name' => $vendor->name,
            'email' => $vendor->email,
            'phone' => $vendor->phone,
            'otp' => $vendor->otp,
            'self_referal_code' => $vendor->self_referal_code,
            'refered_by' => $vendor->refered_by,
            'device_type' => $vendor->device_type
        ];

        $response = [
            'success' => true,
            'data' => $vendorDetail,
            'message' => "Verify otp to register.",
            'code' => 200
        ];

        return response()->json($response, 200);
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'device_type' => ['required', 'integer', 'in:0,1']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                    'data' => [],
                    'code' => 422
                ]);
            }

            $vendor = Vendor::where('phone', $request->input('phone'))->first();

            if ($vendor) {
                $device_type = $request->input('device_type');
                $vendor->device_type = $device_type;
                $vendor->otp = '5678';
                $vendor->save();

                $vendorDetail = [
                    'name' => $vendor->name,
                    'email' => $vendor->email,
                    'phone' => $vendor->phone,
                    'otp' => $vendor->otp,
                    'self_referal_code' => $vendor->self_referal_code,
                    'refered_by' => $vendor->refered_by,
                    'device_type' => $vendor->device_type
                ];

                return response()->json([
                    'success' => true,
                    'message' => 'Please verify, OTP',
                    'data' => $vendorDetail,
                    'code' => 200
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials or user not found.',
                'data' => [],
                'code' => 401
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
                'code' => 500
            ]);
        }
    }

    public function resendOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                    'data' => [],
                    'code' => 422
                ]);
            }

            $vendor = Vendor::where('phone', $request->input('phone'))->first();
            // $otpResponse = $this->sendOtp($request->phone);
            if ($vendor) {
                $vendor->otp = '8765';
                $vendor->save();

                $vendorDetail = [
                    'name' => $vendor->name,
                    'email' => $vendor->email,
                    'phone' => $vendor->phone,
                    'otp' => $vendor->otp,
                    'self_referal_code' => $vendor->self_referal_code,
                    'refered_by' => $vendor->refered_by,
                    'device_type' => $vendor->device_type
                ];

                return response()->json([
                    'success' => true,
                    'message' => 'OTP sent successfully.',
                    'data' => $vendorDetail,
                    'code' => 200
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials or user not found.',
                'data' => [],
                'code' => 401
            ]);
        } catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
                'code' => 500
            ]);
        }
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'otp' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
                'code' => 422
            ]);
        }

        $vendor = Vendor::where('phone', $request->input('phone'))->first();
        if ($vendor && isset($vendor['otp']) && $vendor['otp'] == $request['otp']) {
            $vendorDetail = [
                'access_token' => $vendor->createToken('MyApp')->plainTextToken,
                'name' => $vendor->name,
                'email' => $vendor->email,
                'phone' => $vendor->phone,
                'otp' => $vendor->otp,
                'self_referal_code' => $vendor->self_referal_code,
                'refered_by' => $vendor->refered_by,
                'device_type' => $vendor->device_type,
                'wallet_balance' => 0,
                'is_car_detailed_uploaded' => 'no',
                'is_document_uploaded' => 'no'
            ];

            return response()->json([
                'success' => true,
                'message' => 'Login/Register successfully.',
                'data' => $vendorDetail,
                'code' => 200
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Incorrect OTP.',
            'data' => [],
            'code' => 401
        ]);
    }
}
