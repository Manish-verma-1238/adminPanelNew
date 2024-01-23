<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\BlogsController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\UserProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* Admin routes */

Route::get('/login', [AuthController::class, 'loginView'])->name('view.login');
Route::post('/login/admin', [AuthController::class, 'login'])->name('login');
Route::get('google/login', [AuthController::class, 'googleLogin'])->name('google.login.view');
Route::get('/google/callback', [AuthController::class, 'googleCallback'])->name('google.login');

Route::get('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/forgot/password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/forgot', [AuthController::class, 'forgot'])->name('forgot');
Route::get('/reset-password/{id?}', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('reset');


Route::group(['middleware'=>'auth_check'], function(){
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    /* Blogs route */
    Route::get('/blogs/index', [BlogsController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogsController::class, 'create'])->name('blogs.create');

    /* Category route */
    Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create/{id?}', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.save');
    Route::get('/category/delete/{id?}', [CategoryController::class, 'delete'])->name('category.delete');

    /* Profile route */
    Route::get('/user-profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::post('/save-user-profile', [UserProfileController::class, 'save'])->name('save.user.profile');
});


Route::get('/manish', [AuthController::class, 'manish'])->name('manish');
Route::view('/verma', 'websocket');
