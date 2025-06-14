<?php

use App\Http\Controllers\housedetailscontroller;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Dashboardcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\housecontroller;
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
    return view('Rumsika');
});

Route::get('/Tenant-buyer', [housedetailscontroller::class, 'filterHouse']);
Route::get('/Tenant', [housedetailscontroller::class, 'filterHouse']);
/* Route::get('/House-view', function(){
    return view('House-view'); 
});*/
Route::get('/Landlord-login', function(){
    return view('Landlord-login');
});
Route::post('/Landlord-login', [RegistrationController::class, 'login'])->name('landlord.login');
Route::get('/House-view', function(){
    return  redirect('/Tenant-buyer')->with('error', 'Please select a house to view details.');
});

Route::get('/House-view/{id}', [housedetailscontroller::class, 'show']);
// Show the registration form
Route::get('/Landlord-register', function() {
    return view('Landlord-register');
})->name('landlord.register.form');

// Handle the form submission
Route::post('/Landlord-register', [RegistrationController::class, 'register'])->name('landlord.register');

Route::post('/enquiries', [EnquiryController::class, 'store'])->name('enquiries.store');

Route::get('/Dashboard', [Dashboardcontroller::class, 'index'])->name('dashboard');
Route::post('/house-upload', [housedetailscontroller::class, 'upload'])->name('house.upload');
Route::put('/houses/{id}', [\App\Http\Controllers\housecontroller::class, 'update'])->name('house.update');