<?php

namespace App\Http\Requests;

class AuthRequest extends BaseRequest
{

    public function authorize(): bool
    {
        // This is a guest request, so is it allowed for everyone
        return true;
    }

    public function rules(): array
    {
        if ($this->is('api/auth/login')) {
            return [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ];
        }
        if ($this->is('api/auth/register')) {
            return [
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ];
        }
        return [];
    }
}
