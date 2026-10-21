<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $request->validate([
            'search' => ['sometimes','string'],
            'role' => ['sometimes','string', Rule::in(['admin','cashier','barista'])],
        ]);

        $users = User::when($data['search'] ?? null, function ($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            })
            ->when($data['role'] ?? null, function ($query, $role) {
                $query->where('role', $role);
            })
            ->get();

        return response()->json([
            "success" => true,
            "message"=> "Users retrieved successfully.",
            "total" => $users->count(),
            "data" => UserResource::collection($users)
        ], 200);
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);

        $data = $request->validated();

        $user = User::create($data);

        return response()->json([
            "success" => true,
            "message"=> "User created successfully.",
            "data" => new UserResource(User::find($user->id))
        ], 201);
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        return response()->json([
            "success" => true,
            "message"=> "User retrieved successfully.",
            "data" => new UserResource($user)
        ], 200);
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validated();

        $user->update($data);

        return response()->json([
            "success" => true,
            "message"=> "User updated successfully.",
            "data" => new UserResource($user)
        ], 200);
    }

    public function updatePassword(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validate([
            'old_password' => ['required', 'string', Password::defaults()],
            'password' => ['required', 'confirmed', Password::defaults()]
        ]);

        if (!Hash::check($data['old_password'], $user->password)) {
            return response()->json([
                "success" => false,
                "message"=> "The current password is incorrect.",
                "data" => null
            ], 422);
        }

        $user->update([
            'password' => $data['password']
        ]);

        return response()->json([
            "success" => true,
            "message"=> "User password updated successfully.",
            "data" => null
        ], 200);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json([
            "success" => true,
            "message"=> "User deleted successfully.",
            "data" => null
        ]);
    }
}
