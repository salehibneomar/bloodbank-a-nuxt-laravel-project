<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Jobs\InvalidateDonorCacheJob;

class AdminControlService
{

    private function isSameUser(int $userId): bool
    {
        return Auth::user()->id === $userId;
    }

    public function changeStatus(int $userId, bool $status): bool | User
    {
        if($this->isSameUser($userId)) {
            return false;
        }
        $user = User::findOrFail($userId);
        $user->is_active = $status ? 1 : 0;
        $user->save();

        if ($user->is_active == 0 && method_exists($user, 'tokens')) {
            $user->tokens()->delete();
        }

        dispatch(new InvalidateDonorCacheJob());

        return $user;
    }
}
