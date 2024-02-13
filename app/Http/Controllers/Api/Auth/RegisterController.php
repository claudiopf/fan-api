<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'npp' => ['required'],
            'password' => ['required', 'min:8']
        ]);

        $registered = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'npp' => $request->npp,
            'npp_supervisor' => $request->npp_supervisor,
            'password' => bcrypt($request->password)
        ]);

        $token = $registered->createToken('absen')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }
}
