<?php

use App\Http\Controllers\housedetailscontroller;
use Illuminate\Support\Facades\Route;

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
Route::get('/Tenant', function(){
    return view('Tenant-buyer');
});
/* Route::get('/House-view', function(){
    return view('House-view'); 
});*/
Route::get('/Landlord-login', function(){
    return view('Landlord-login');
});
Route::get('/House-view', [housedetailscontroller::class, 'findHouse']);