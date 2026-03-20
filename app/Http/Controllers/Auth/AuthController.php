<?php

namespace App\Http\Controllers\Auth;

use App\Models\User\User;
use App\Models\User\Roles;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController
{
    //Register user
    public function register(StoreUserRequest $request)
    {
        //Validate
        $fields = $request->validated();

        $username = $this->generateUniqueUsername();

        // Registracija korisnika sa generisanim username-om
        $user = User::create([
            'name' => $fields['name'],
            'username' => $username,
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'created_at' => now(),
        ]);

        $defaultRole = Roles::firstOrCreate([
            'role_name' => 'korisnik',
        ]);
        $user->roles()->syncWithoutDetaching([$defaultRole->id]);

        //Login
        Auth::login($user);

        //Redirect
        return redirect(route('index'))->with('success', __('messages.registered_success'));
    }

    //Login user
    public function login(UpdateUserRequest $request)
    {
        $fields = $request->validated();

        $remember = (bool) $request->boolean('remember');

        if (Auth::attempt(['email' => $fields['email'], 'password' => $fields['password']], $remember)) {
            $request->session()->regenerate();
            return redirect($request->input('intended', route('index')))
                ->with('success', __('messages.logged_in_success'));
        }

        return back()->withErrors([
            'email' => __('auth.failed'),
        ])->onlyInput('email');
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
        return redirect()->back()->with('success', __('messages.logged_out_success'));
    }

    private function generateUniqueUsername(): string
    {
        do {
            $candidate = 'user_' . Str::lower(Str::random(10));
        } while (User::query()->where('username', $candidate)->exists());

        return $candidate;
    }
}
