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
        $isActive = false;

        if($isSuccessful){
            /** @var User|null $user */
            $user = Auth::user();
            if (isset($user) && $user !==null) {
                $user->tokens()->delete();
                if($user->is_active){
                    $token = $user->createToken('api_token')->plainTextToken;
                    $isActive = true;
                }
            }
        }

        return [
            'attempt' => $isSuccessful,
            'user' => $user,
            'token' => $token,
            'is_active' => $isActive
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
