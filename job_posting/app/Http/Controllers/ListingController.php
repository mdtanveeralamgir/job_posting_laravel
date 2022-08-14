<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

        $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(6);
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
        $formFields = $request->validate(
            [
                'title' => 'required',
                'company' => 'required', Rule::unique('listings', 'company'),
                'location' => 'required',
                'website' => 'required',
                'email' => 'required',
                'tags' => 'required',
                'description' => 'required'
            ]
        );

        Listing::create($formFields);

        //One way to do flash message
        // Session::flash('message', 'Listing Created');


        //Another flash msg way is to use with with the redirect
        return redirect()->route('home')->with('message', 'Listing created');
    }
}
