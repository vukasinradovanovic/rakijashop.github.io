<?php

namespace App\Http\Controllers\Auth;

use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    //Register user
    public function register(Request $request)
    {
        //Validate
        $fields = $request->validate([
            'name' => ['required', 'max:255', 'regex:/^([A-ZČĆŽŠĐ][a-zčćžšđ]+)( [A-ZČĆŽŠĐ][a-zčćžšđ]+){0,2}$/u'],
            'email' => ['required', 'max:255', 'email', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => ['required', 'min:5', 'confirmed'],
            'terms' => 'required',
        ]);

        // Registracija korisnika sa generisanim username-om
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        //Login
        Auth::login($user);

        //Redirect
        return redirect(route('index'))->with('success', 'Uspešno ste se registrovali!');
    }

    //Login user
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required']
        ]);

        return redirect($request->input('intended', route('index')))
            ->with('success', 'Uspešno ste se prijavili!');
    }
    //Logout
    public function logout(Request $request)
    {
        //Logout user
        Auth::logout();

        //Invalidate user's session
        $request->session()->invalidate();

        //Regenerate CSRF token
        $request->session()->regenerateToken();

        //Redirection to index
        return redirect()->back()->with('success', 'Uspešno ste se odjavili!');
    }
}
