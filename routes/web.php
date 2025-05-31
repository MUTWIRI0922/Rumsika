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

Route::get('/Tenant-buyer', [housedetailscontroller::class, 'filterHouse']);
Route::get('/Tenant', [housedetailscontroller::class, 'filterHouse']);
/* Route::get('/House-view', function(){
    return view('House-view'); 
});*/
Route::get('/Landlord-login', function(){
    return view('Landlord-login');
});
Route::get('/House-view', function(){
    return  redirect('/Tenant-buyer')->with('error', 'Please select a house to view details.');
});


Route::get('/House-view/{id}', [housedetailscontroller::class, 'show']);