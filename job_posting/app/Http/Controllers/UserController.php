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

    public function logout(Request $request)
    {
        auth()->logout(); //Remove the auth info from user session

        //Invalidate users session and regerate users csrf token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('message', 'You have been logged out');
    }

    //Show login form
    public function login()
    {
        return view('users.login');
    }

    //Authenticate user
    public function authenticate(Request $request)
    {
        $formData = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formData))
        {
            $request->session()->regenerate();

            return redirect()->route('home')->with('message', 'You have successfully logged in');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
