<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Auth\Role;
use App\Models\User\User;
use App\Models\User\UserStatus;

class DashboardUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.dashboardUser.dashboardUsers');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'role_id' => ['nullable', 'exists:roles,id'],
            'edited_username' => [
                'nullable',
                Rule::unique('users', 'edited_username')->ignore($id),
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'status_id' => ['nullable', 'exists:user_statuses,id'],
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Korisnik nije pronađen'], 404);
        }

        $update = [];
        if ($request->has('edited_username')) {
            $update['edited_username'] = $request->edited_username;
        }
        if ($request->has('email')) {
            $update['email'] = $request->email;
        }
        if ($request->has('status_id')) {
            $update['user_status_id'] = $request->status_id;
        }

        if (!empty($update)) {
            $user->update($update);
        }
        
        if ($request->filled('role_id')) {
            $user->roles()->sync([$request->role_id]);
        }

        return response()->json(['message' => 'Status uspešno ažuriran']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');

        $users = User::where('default_username', 'LIKE', "%{$searchQuery}%")
            ->orWhere('edited_username', 'LIKE', "%{$searchQuery}%")
            ->with('statuses', 'roles')
            ->get();

        return response()->json([
            'users' => $users,
            'roles' => Role::all(),
            'statuses' => UserStatus::all()
        ]);
    }
}
