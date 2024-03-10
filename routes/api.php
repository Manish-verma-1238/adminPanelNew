<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VendorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('vendor')->middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/upload-images', [VendorController::class, 'uploadImages'])->name('upload-images');
});

Route::prefix('vendor')->group(function () {
    Route::post('/register', [VendorController::class, 'register'])->name('register');
    Route::post('/login', [VendorController::class, 'login'])->name('login');
    Route::post('/resend-otp', [VendorController::class, 'resendOtp'])->name('resend-otp');
    Route::post('/verify-otp', [VendorController::class, 'verifyOtp'])->name('verify-otp');
    Route::post('/logout', [VendorController::class, 'logout'])->name('logout');
});
