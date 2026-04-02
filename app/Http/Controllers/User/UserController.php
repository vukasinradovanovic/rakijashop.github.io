<?php

namespace App\Http\Controllers\User;


use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($locale, $username)
    {
        $user = User::findByUsername($username)->firstOrFail();
        $products = $user->products()->latest()->get();

        return view('user.showUserPage', [
            'user' => $user,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($locale, $username)
    {
        $user = User::findByUsername($username)->firstOrFail();

        return view('user.editUserPage', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $locale, $username): RedirectResponse
    {
        $user = User::findByUsername($username)->firstOrFail();

        if ((int) Auth::id() !== (int) $user->id) {
            abort(403);
        }

        $user->update($request->validated());

        return redirect()->route('user.show', [
            'locale' => app()->getLocale(),
            'user' => $this->routeUserKey($user),
        ])->with('status', __('pages.user_profile.form.saved'));
    }

    private function routeUserKey(User $user): string
    {
        if (filled($user->username)) {
            return $user->username;
        }

        return (string) $user->id;
    }

    private function resolveUserFromRouteValue(string $value): User
    {
        $userByUsername = User::findByUserName($value)->first();

        if ($userByUsername !== null) {
            return $userByUsername;
        }

        if (ctype_digit($value)) {
            return User::query()->findOrFail((int) $value);
        }

        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
