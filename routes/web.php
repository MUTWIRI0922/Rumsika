<?php

use App\Http\Controllers\housedetailscontroller;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Dashboardcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\housecontroller;
use App\Http\Controllers\HouseviewsController;
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

Route::get('/Tenant-buyer', [housedetailscontroller::class, 'allHouses'])->name('tenant.buyer');
// Route::get('/Tenant', [housedetailscontroller::class, 'filterHouse']);
/* Route::get('/House-view', function(){
    return view('House-view'); 
});*/
Route::get('/Landlord-login', function(){
    return view('Landlord-login');
});
Route::get('/Landlord-logout', [RegistrationController::class, 'logout'])->name('landlord.logout');
Route::post('/Landlord-login', [RegistrationController::class, 'login'])->name('landlord.login');
Route::get('/House-view', function(){
    return  redirect('/Tenant-buyer')->with('error', 'Please select a house to view details.');
});
Route::post('/House-view/{id}', [HouseviewsController::class, 'record'])->name('house.view.record');
Route::get('/House-view/{id}', [housedetailscontroller::class, 'show'])->name('house.show');
// Show the registration form
Route::get('/Landlord-register', function() {
    return view('Landlord-register');
})->name('landlord.register.form');


Route::post('/Landlord-register', [RegistrationController::class, 'register'])->name('landlord.register');
Route::post('updateProfile', [RegistrationController::class, 'updateProfile'])->name('landlord.updateProfile');
Route::post('/landlord/change-password', [RegistrationController::class, 'changePassword'])->name('landlord.changePassword');
Route::post('/otp/send', [RegistrationController::class, 'sendOtp'])->name('otp.send');
Route::post('/otp/verify', [RegistrationController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/otp/request', function() { return view('auth.otp-request'); })->name('otp.request');
Route::get('/otp/verify', function() { return view('auth.otp-verify'); })->name('otp.verify.form');
Route::post('/enquiries', [EnquiryController::class, 'store'])->name('enquiries.store');
Route::post('/password-reset', [RegistrationController::class, 'resetPassword'])->name('password.reset');
Route::get('/password-reset', function() {
    return view('auth.password-reset');
})->name('password.reset.form');
Route::middleware(['landlord.auth'])->group(function () {
    Route::get('/Dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // ...other protected routes
});

Route::post('/house-upload', [housedetailscontroller::class, 'upload'])->name('house.upload');
// Route::get('/house-upload', function(){return view ('Dashboard', ['section' => 'add-house']);});

Route::put('/houses/{id}', [\App\Http\Controllers\housecontroller::class, 'update'])->name('house.update');
Route::delete('/houses/{id}', [\App\Http\Controllers\housecontroller::class, 'delete'])->name('house.delete');

// admin dashboard routes
Route::get('/admin', function() { return view('Admin.Admin'); })->name('admin.dashboard');