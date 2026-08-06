<?php

use App\Http\Controllers\housedetailscontroller;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Dashboardcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\housecontroller;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\HouseviewsController;
use App\Http\Controllers\Admin\Dashboardcontroller as AdminDashboardController;
use App\Http\Controllers\Admin\Authcontroller;
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
// web visitor routes
Route::get('/tenant-buyer', [housedetailscontroller::class, 'allHouses'])->name('tenant.buyer');
// Route::get('/Tenant', [housedetailscontroller::class, 'filterHouse']);
/* Route::get('/House-view', function(){
    return view('House-view'); 
});*/
Route::get('/landlordlogin', function(){
    return view('Landlord-login');
})->name('landlord.loginpage');
Route::get('/landlordlogout', [RegistrationController::class, 'logout'])->name('landlord.logout');
Route::post('/landlordlogin', [RegistrationController::class, 'login'])->name('landlord.login');
Route::get('/houseview', function(){
    return  redirect('/Tenant-buyer')->with('error', 'Please select a house to view details.');
});
Route::post('/houseview/{id}', [HouseviewsController::class, 'record'])->name('house.view.record');
Route::get('/houseview/{id}', [housedetailscontroller::class, 'show'])->name('house.show');
Route::get('/house/listerprofile/{id}',[RegistrationController::class, 'lister_profile'])->name('listerprofile');
Route::resource('/lister/reviews', ReviewsController::class)->names([
    'create' => 'reviews.create',
    'store' => 'reviews.store',
    'index' => 'reviews.index',
    'show' => 'reviews.show',
    'update' => 'reviews.update',
    'edit' => 'reviews.edit',
    'destroy' => 'reviews.destroy'
]);

// Show the registration form
Route::get('/landlordregister', function() {
    return view('Landlord-register');
})->name('landlord.register.form');


Route::post('/landlordregister', [RegistrationController::class, 'register'])->name('landlord.register');
// send otp
Route::post('/otp/send', [RegistrationController::class, 'sendOtp'])->name('otp.send');
// verify otp
Route::post('/otp/verify', [RegistrationController::class, 'verifyOtp'])->name('otp.verify');
// otp reques
Route::get('/otp/request', function() { return view('auth.otp-request'); })->name('otp.request');
Route::get('/otp/verify', function() { return view('auth.otp-verify'); })->name('otp.verify.form');
Route::post('/enquiries', [EnquiryController::class, 'store'])->name('enquiries.store');
Route::post('/password-reset', [RegistrationController::class, 'resetPassword'])->name('password.reset');
Route::get('/password-reset', function() {
    return view('auth.password-reset');
})->name('password.reset.form');

// landlord dashboard routes
Route::middleware(['landlord.auth'])->group(function () {
    Route::get('/landlord/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // ...other protected routes
    Route::get('/landlord/add-house', function() {
        return view('Landlord.houseupload');
    })->name('dashboard.add-house');
    Route::get('/landlord/houses', [DashboardController::class, 'landlordHouses'])->name('landlord.houses');
    Route::post('/house-upload', [housedetailscontroller::class, 'upload'])->name('house.upload');
    Route::get('/landlord/houses/{id}', [DashboardController::class, 'showHouseDetails'])->name('landlord.house.details');
    Route::get('/landlord/houses/{id}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit-house');
    Route::get('/landlord/profile', [RegistrationController::class, 'showProfile'])->name('landlord.profile');
    Route::get('/landlord/profile/edit', [RegistrationController::class, 'editProfile'])->name('landlord.editProfile');
    Route::post('/landlord/updateProfile', [RegistrationController::class, 'updateProfile'])->name('landlord.updateProfile');
    Route::get('/landlord/change-password', function() {
        return view('Landlord.passwordchange');
    })->name('landlord.passwordchange');
    Route::post('/landlord/change-password', [RegistrationController::class, 'changePassword'])->name('landlord.changePassword');
    Route::put('/houses/{id}', [\App\Http\Controllers\DashboardController::class, 'houseupdate'])->name('house.update');
    Route::delete('/houses/{id}', [\App\Http\Controllers\DashboardController::class, 'housedelete'])->name('house.delete');
    Route::get('/landlord/support', function() {
        return view('Landlord.support');
    })->name('landlord.support');
});



Route::get('/adminsrstrd/login', function() {
    return view('Admin.login');
})->name('admin.loginform');
Route::post('/adminsrstrd/login', [Authcontroller::class, 'login'])->name('admin.login');
// admin dashboard routes
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/logout', [Authcontroller::class, 'logout'])->name('admin.logout');
    // admin kyc requests routes
    Route::get('/admin/kyc-requests', function() { return view('Admin.kycRequests'); })->name('admin.kyc.requests');
    Route::get('/admin/kyc-requests/{id}', [\App\Http\Controllers\Admin\KYCcontroller::class, 'kycRequestDetails'])->name('admin.kyc.request.details');
    Route::post('/admin/kyc-requests/{id}/approve', [\App\Http\Controllers\Admin\KYCcontroller::class, 'approveKycRequest'])->name('admin.kyc.request.approve');
    Route::post('/admin/kyc-requests/{id}/reject', [\App\Http\Controllers\Admin\KYCcontroller::class, 'rejectKycRequest'])->name('admin.kyc.request.reject');    
    // admin users routes
    Route::get('/admin/userssearch', [\App\Http\Controllers\Admin\Usercontroller::class, 'searchUsers'])->name('admin.users.search');
    Route::get('/admin/users', [\App\Http\Controllers\Admin\Usercontroller::class, 'listUsers'])->name('admin.users');
    Route::get('/admin/users/{id}', [\App\Http\Controllers\Admin\Usercontroller::class, 'userDetails'])->name('admin.user.details');
    Route::get('/admin/users/{id}/edit', [\App\Http\Controllers\Admin\Usercontroller::class, 'editUser'])->name('admin.user.edit');
    Route::put('/admin/users/{id}', [\App\Http\Controllers\Admin\Usercontroller::class, 'updateUser'])->name('admin.user.update');
    Route::post('/admin/users/{id}/suspend', [\App\Http\Controllers\Admin\Usercontroller::class, 'suspendUser'])->name('admin.user.suspend');
    Route::post('/admin/users/{id}/activate', [\App\Http\Controllers\Admin\Usercontroller::class, 'activateUser'])->name('admin.user.activate');
    // admin user listings routes
    Route::get('/admin/users/{id}/listings', [\App\Http\Controllers\Admin\Userlistingcontroller::class, 'userListings'])->name('admin.user.listings');
    Route::get('/admin/users/{landlord_id}/listings/{listingId}', [\App\Http\Controllers\Admin\Userlistingcontroller::class, 'userListingDetails'])->name('admin.user.listing.details');
    Route::get('/admin/users/{landlord_id}/listings/{listingId}/edit', [\App\Http\Controllers\Admin\Userlistingcontroller::class, 'editUserListing'])->name('admin.user.listing.edit');
    Route::put('/admin/users/{landlord_id}/listings/{id}/update', [\App\Http\Controllers\Admin\Userlistingcontroller::class, 'updateUserListing'])->name('admin.user.listing.update');
    Route::post('/admin/users/{landlord_id}/listings/{listingId}/bringdown', [\App\Http\Controllers\Admin\Userlistingcontroller::class, 'suspendUserListing'])->name('admin.user.listing.suspend');
    Route::post('/admin/users/{landlord_id}/listings/{listingId}/restore', [\App\Http\Controllers\Admin\Userlistingcontroller::class, 'restoreUserListing'])->name('admin.user.listing.restore');

    // admin password change routes
    Route::get('/admin/change-password', function() {
        return view('Admin.settings.password');
    })->name('admin.passwordchange');
    route::get('/admin/profile', [Authcontroller::class, 'showProfile'])->name('admin.profile');
    route::post('/admin/profile/update', [Authcontroller::class, 'updateProfile'])->name('admin.updateProfile');
    Route::post('/admin/change-password', [Authcontroller::class, 'changePassword'])->name('admin.changePassword');
});
