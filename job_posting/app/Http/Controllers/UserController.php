<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;



class UserController extends Controller
{
    //Register form display
    public function create()
    {
        return view('users.register');
    }

    //Store user info to register
    public function store(Request $request)
    {
        $formData = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required' , 'confirmed', 'min:6'],
        ]);

        //Hash Password

        //Create user
        $user = User::create($formData);

        //Login
        auth()->login($user);

        return redirect()->route('home')->with('message', 'User registered successfully logged in');
    }
}
