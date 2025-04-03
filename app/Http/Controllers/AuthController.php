<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Aquí debes agregar la lógica para autenticar al usuario
        // Usualmente, es algo como:
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json(['token' => $user->createToken('token-name')->plainTextToken]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}


