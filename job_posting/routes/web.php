<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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


//All listing
Route::get('/', [ListingController::class, 'index'])->name('home');


//Group middleware to check authentication
Route::middleware(['auth'])->group(function (){

    //Show create form
    Route::get('/listings/create', [ListingController::class, 'create'])->name('createListing');

    //Create listing submit form
    Route::post('/listings', [ListingController::class, 'store'])->name('storeListing');

    //show edit form for listing
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('editListing');
    //Edit listing submit form
    Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('updateListing');
    //Delete a listing
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);
    //Logout user
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

});





//Single listing
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('singleListing');


//Authentication

//Show register/user create form
Route::get('/register', [UserController::class, 'create'])->name('registerUser');

//Create new user by submitting register form
Route::post('/users', [UserController::class, 'store'])->name('storeUser');



//Show login form
Route::get('/login', [UserController::class, 'login'])->name('loginForm');

//Login user
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->name('authenticateUser');

