<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $tagFilter = trim($request->tag);
        $listings = null;
        if($tagFilter)
        {
            $listings = DB::table('listings')->where('tags', 'like', '%'. $tagFilter . '%')->get();    
        }
        else
        {
            $listings = Listing::all();
        }
        return view('listings.index', compact('listings'));
    }

    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }
}
