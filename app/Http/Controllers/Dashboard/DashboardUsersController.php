<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User\Roles;
use App\Models\User\User;
use App\Models\User\UserStatus;

class DashboardUsersController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Roles::query()->orderBy('role_name')->get();
        $statuses = UserStatus::query()->orderBy('status')->get();

        return view('dashboard.dashboardUser.dashboardUsers', [
            'roles' => $roles,
            'statuses' => $statuses,
        ]);
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
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'username' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($id),
            ],
            'status_id' => ['nullable', 'exists:user_statuses,id'],
        ]);

        $user = User::with('roles')->find($id);

        if (!$user) {
            return response()->json(['message' => __('dashboard.users.user_not_found')], 404);
        }

        $update = [];
        if (array_key_exists('email', $fields)) {
            $update['email'] = $fields['email'];
        }
        if (array_key_exists('username', $fields)) {
            $update['username'] = $fields['username'];
        }
        if (array_key_exists('status_id', $fields)) {
            $update['user_status_id'] = $fields['status_id'];
        }

        if (!empty($update)) {
            $user->update($update);
        }

        if (array_key_exists('role_id', $fields) && !empty($fields['role_id'])) {
            $user->roles()->sync([(int) $fields['role_id']]);
        }

        return response()->json(['message' => __('dashboard.users.update_success')]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function data(Request $request)
    {
        $params = $request->validate([
            'query' => ['nullable', 'string', 'max:120'],
            'role_id' => ['nullable', 'integer', 'exists:roles,id'],
            'status_id' => ['nullable', 'integer', 'exists:user_statuses,id'],
            'sort_by' => ['nullable', Rule::in(['id', 'email', 'username', 'created_at'])],
            'sort_dir' => ['nullable', Rule::in(['asc', 'desc'])],
            'per_page' => ['nullable', 'integer', 'min:5', 'max:50'],
            'page' => ['nullable', 'integer', 'min:1'],
        ]);

        $query = User::query()->with(['roles:id,role_name', 'statuses:id,status']);

        if (!empty($params['query'])) {
            $searchTerm = $params['query'];
            $query->where(function ($builder) use ($searchTerm) {
                $builder->where('username', 'like', "%{$searchTerm}%")
                    ->orWhere('name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%")
                    ->orWhere('id', 'like', "%{$searchTerm}%")
                    ->orWhereHas('roles', function ($roleQuery) use ($searchTerm) {
                        $roleQuery->where('role_name', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('statuses', function ($statusQuery) use ($searchTerm) {
                        $statusQuery->where('status', 'like', "%{$searchTerm}%");
                    });
            });
        }

        if (!empty($params['role_id'])) {
            $roleId = (int) $params['role_id'];
            $query->whereHas('roles', function ($roleQuery) use ($roleId) {
                $roleQuery->where('roles.id', $roleId);
            });
        }

        if (!empty($params['status_id'])) {
            $query->where('user_status_id', (int) $params['status_id']);
        }

        $sortBy = $params['sort_by'] ?? 'id';
        $sortDir = $params['sort_dir'] ?? 'desc';
        $perPage = (int) ($params['per_page'] ?? 10);

        $users = $query->orderBy($sortBy, $sortDir)->paginate($perPage);

        return response()->json([
            'users' => $users->through(function (User $user) {
                $activeRole = $user->roles->first();

                return [
                    'id' => $user->id,
                    'username' => $user->username,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role_id' => $activeRole?->id,
                    'status_id' => $user->user_status_id,
                    'roles' => $user->roles,
                ];
            }),
            'roles' => Roles::query()->orderBy('role_name')->get(['id', 'role_name']),
            'statuses' => UserStatus::query()->orderBy('status')->get(['id', 'status']),
            'meta' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'total' => $users->total(),
            ],
        ]);
    }

    public function search(Request $request)
    {
        $fields = $request->validate([
            'query' => ['nullable', 'string', 'max:120'],
        ]);

        $searchQuery = trim((string) ($fields['query'] ?? ''));

        if ($searchQuery === '') {
            return response()->json([
                'users' => [],
                'roles' => Roles::all(),
                'statuses' => UserStatus::all(),
            ]);
        }

        $users = User::query()
            ->where('username', 'LIKE', "%{$searchQuery}%")
            ->orWhere('name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('email', 'LIKE', "%{$searchQuery}%")
            ->with('statuses', 'roles')
            ->get();

        return response()->json([
            'users' => $users,
            'roles' => Roles::all(),
            'statuses' => UserStatus::all()
        ]);
    }
}
