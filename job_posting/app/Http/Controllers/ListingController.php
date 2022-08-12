<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller
{
    public function index()
    {
        $listings = null;
        // if($tagFilter)
        // {
        //     $listings = DB::table('listings')->where('tags', 'like', '%'. $tagFilter . '%')->get();
        // }
        // else
        // {
        //     $listings = Listing::latest()->get(); //Sort by id assending
        // }

        $listings = Listing::latest()->filter(request(['tag', 'search']))->get();
        return view('listings.index', compact('listings'));
    }

    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }

    //show create form
    public function create()
    {
        return view('listings.create');
    }

    //storing data
    public function store(Request $request)
    {
        dd($request->all());
    }
}
