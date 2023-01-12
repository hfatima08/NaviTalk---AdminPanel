<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [adminController::class,'index']);
Route::post('/process', [adminController::class,'process_login']);
Route::get('/dashboard', [adminController::class,'dashboard'])->name('dashboard');
Route::get('/logout', [adminController::class,'logout'])->name('logout');

//user routes
Route::get('admin/userrecords', [adminController::class,'user_record'])->name('users');

//volunteer routes
Route::get('admin/volunteerrecords', [adminController::class,'vol_record'])->name('volunteer');

//both user record route
Route::get('admin/allrecords', [adminController::class,'all_record'])->name('all');
