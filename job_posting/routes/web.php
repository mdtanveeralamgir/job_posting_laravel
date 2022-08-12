<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('listings', [
        'listings' => Listing::all()]
    );
})->name('home');

Route::get('/listing/{listing}', function(Listing $listing){
    return view('singleListing', 
    [
        'listing' => $listing
    ]
);
})->name('singleListing');
