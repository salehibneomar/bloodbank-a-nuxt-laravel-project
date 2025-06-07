<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthService{

    public function login (Request $request) : array
    {
        $credentials = $request->only('email', 'password');
        $isSuccessful = !!(Auth::attempt($credentials));
        $token = null;
        $user = null;

        if($isSuccessful){
            /** @var User|null $user */
            $user = Auth::user();

            if ($user) {
                $user->tokens()->delete();
                $token = $user->createToken('api_token')->plainTextToken;
            }
        }

        return [
            'attempt' => $isSuccessful,
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout(): User | null
    {
    /** @var User | null auth $user */
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();
        }
        return $user;
    }

}
