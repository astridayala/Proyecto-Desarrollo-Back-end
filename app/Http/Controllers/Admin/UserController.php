<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json(['data' => $users], 200);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'telephone' => 'required|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'telephone' => $validated['telephone'],
        ]);

        return response()->json(['message' => 'User registered', 'data' => $user], 200);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => 'string|email',
            'role' => 'string',
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return response()->json(['message' => 'User updated', 'data' => $user], 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted'], 200);
    }

    public function assignRole(Request $request, $id)
    {
        $validated = $request->validate([
            'role' => 'required|string|in:admin,bibliotecario,usuario',
        ]);

        $user = User::findOrFail($id);
        $user->assignRole($validated['role']);

        return response()->json(['message' => 'Role assigned'], 200);
    }
}
