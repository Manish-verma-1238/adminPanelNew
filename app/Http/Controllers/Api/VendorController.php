<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Api\Vendor;
use App\Models\Api\VendorLoginDetail;
use Laravel\Sanctum\PersonalAccessToken;

class VendorController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:vendors',
                'phone' => 'required|unique:vendors',
                'device_type' => ['required', 'integer', 'in:0,1'],
                'device_token' => 'required'
            ]);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors(),
                    'data' => [],
                    'code' => 400
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
                'self_referal_code' => $referralCode,
                'refered_by' => $request->refered_by
            ]);
            $vendor->save();

            $VendorLoginDetail = new VendorLoginDetail([
                'vendor_id' => $vendor->id,
                'phone' => $vendor->phone,
                'otp' => '1234',
                'device_type' => $request->device_type,
                'device_token' => $request->device_token,

            ]);
            $VendorLoginDetail->save();

            // $success['token'] = $user->createToken('MyApp')->plainTextToken;

            $vendorDetail = [
                'id' => $vendor->id,
                'name' => $vendor->name,
                'email' => $vendor->email,
                'phone' => $vendor->phone,
                'otp' => $vendor->otp,
                'self_referal_code' => $vendor->self_referal_code,
                'refered_by' => $vendor->refered_by,
                'device_type' => $VendorLoginDetail->device_type,
                'device_token' => $VendorLoginDetail->device_token,
                'created_at' => $VendorLoginDetail->created_at,
                'updated_at' => $VendorLoginDetail->updated_at
            ];

            $response = [
                'success' => true,
                'message' => "Verify otp to register.",
                'data' => $vendorDetail,
                'code' => 200
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
                'code' => 500
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'device_type' => ['required', 'integer', 'in:0,1'],
                'device_token' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                    'data' => [],
                    'code' => 400
                ]);
            }

            $vendor = Vendor::where(['phone' => $request['phone']])->first();
            if ($vendor) {
                $VendorLoginDetail = VendorLoginDetail::where(['device_type' => $request['device_type'], 'device_token' => $request['device_token']])->first();
                if ($VendorLoginDetail) {
                    $VendorLoginDetail->otp = '5678';
                    $VendorLoginDetail->save();
                } else {
                    $VendorLoginDetail = new VendorLoginDetail([
                        'vendor_id' => $vendor->id,
                        'phone' => $vendor->phone,
                        'otp' => '5678',
                        'device_type' => $request->device_type,
                        'device_token' => $request->device_token,

                    ]);
                    $VendorLoginDetail->save();
                }

                $vendorDetail = [
                    'id' => $vendor->id,
                    'name' => $vendor->name,
                    'email' => $vendor->email,
                    'phone' => $vendor->phone,
                    'otp' => $VendorLoginDetail->otp,
                    'self_referal_code' => $vendor->self_referal_code,
                    'refered_by' => $vendor->refered_by,
                    'device_type' => $VendorLoginDetail->device_type,
                    'device_token' => $VendorLoginDetail->device_token,
                    'created_at' => $VendorLoginDetail->created_at,
                    'updated_at' => $VendorLoginDetail->updated_at
                ];

                return response()->json([
                    'success' => true,
                    'message' => 'Verify OTP to login.',
                    'data' => $vendorDetail,
                    'code' => 200
                ]);
            }
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
                'phone' => 'required',
                'device_type' => ['required', 'integer', 'in:0,1'],
                'device_token' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                    'data' => [],
                    'code' => 400
                ]);
            }

            $vendor = VendorLoginDetail::where(['phone' => $request['phone'], 'device_type' => $request['device_type'], 'device_token' => $request['device_token']])->with('vendor')->first();
            // $otpResponse = $this->sendOtp($request->phone);
            if ($vendor) {
                $vendor->otp = '8765';
                $vendor->save();

                $vendorDetail = [
                    'id' => $vendor->vendor->id,
                    'name' => $vendor->vendor->name,
                    'email' => $vendor->vendor->email,
                    'phone' => $vendor->vendor->phone,
                    'otp' => $vendor->otp,
                    'self_referal_code' => $vendor->vendor->self_referal_code,
                    'refered_by' => $vendor->vendor->refered_by,
                    'device_type' => $vendor->device_type,
                    'device_token' => $vendor->device_token,
                    'created_at' => $vendor->created_at,
                    'updated_at' => $vendor->updated_at
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
                'code' => 400
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
            'otp' => 'required',
            'device_type' => ['required', 'integer', 'in:0,1'],
            'device_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => [],
                'code' => 400
            ]);
        }

        $vendor = Vendor::where(['phone' => $request['phone']])->first();
        $vendorLoginDetails = VendorLoginDetail::where(['phone' => $request['phone'], 'device_type' => $request['device_type'], 'device_token' => $request['device_token'], 'otp' => $request['otp']])->first();

        if ($vendor && $vendorLoginDetails) {
            $eixstingToken = $vendor->tokens()->where('name', 'MyApp' . $vendorLoginDetails->id);
            if ($eixstingToken) {
                $eixstingToken->delete();
            }
            $tokenResult = $vendor->createToken('MyApp' . $vendorLoginDetails->id);
            $vendorDetail = [
                'access_token' => $tokenResult->plainTextToken,
                'id' => $vendorLoginDetails->vendor->id,
                'name' => $vendorLoginDetails->vendor->name,
                'email' => $vendorLoginDetails->vendor->email,
                'phone' => $vendorLoginDetails->vendor->phone,
                'otp' => $vendorLoginDetails->otp,
                'self_referal_code' => $vendorLoginDetails->vendor->self_referal_code,
                'refered_by' => $vendorLoginDetails->vendor->refered_by,
                'device_type' => $vendorLoginDetails->device_type,
                'device_token' => $vendorLoginDetails->device_token,
                'wallet_balance' => 0,
                'is_car_detailed_uploaded' => 'no',
                'is_document_uploaded' => 'no',
                'created_at' => $vendorLoginDetails->created_at,
                'updated_at' => $vendorLoginDetails->updated_at
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
            'message' => 'Incorrect OTP. Please enter correct OTP',
            'data' => [],
            'code' => 401
        ]);
    }

    public function logout(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'access_token' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                    'data' => [],
                    'code' => 400
                ]);
            }
            $token = PersonalAccessToken::findToken($request['access_token']);
            $loginId = $token['name'] ?? 0;
            $numericValue = (int) filter_var($loginId, FILTER_SANITIZE_NUMBER_INT);

            if (VendorLoginDetail::find($numericValue) && VendorLoginDetail::find($numericValue)->delete() && $token->delete()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Logout successfully.',
                    'data' => [],
                    'code' => 200
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Record not found. Unable to Logout',
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

    public function uploadImages(Request $request)
    {
        try{ 
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $folderName = $request['image_of'] ?? 'images';
            // Check if the folder exists, if not create it
            $folderPath = public_path('vendors/'.$folderName);
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($folderPath, $filename);
            $imagePath = url('vendors/'.$folderName.'/' . $filename);
            $responseData = [
                'success' => true,
                'message' => "Image uploaded successfully.",
                'image_path' => $imagePath,
                'image_name' => $request['image_name'],
                'data' => [],
                'code' => 200,                

            ];
            return response()->json($responseData, 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
                'code' => 500
            ]);
        }
    }
}
