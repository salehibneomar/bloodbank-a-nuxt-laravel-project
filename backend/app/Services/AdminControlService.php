<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Jobs\InvalidateDonorCacheJob;
use Illuminate\Support\Facades\DB;
use App\Enums\AdminCache;
use App\Jobs\AdminDashboardCacheJob;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminControlService
{

    private function isSameUser(int $userId): bool
    {
        return Auth::user()->id === $userId;
    }

    public function manageDonors(Request $request) : LengthAwarePaginator
    {
        $perPage = $request->get('per_page', 10);
        $email = $request->get('email');

        $query = DB::table('donor_view');

        if ($email) {
            $query = $query->where('email', 'LIKE', '%' . $email . '%');
        }

        return $query->paginate($perPage);
    }

    public function getDashboardData(): array
    {
        $cacheKey = 'admin:dashboard:data';
        $commonTag = AdminCache::DASHBOARD_TAG->value;
        $cachedData = $result = cache()->tags([$commonTag])->get($cacheKey);

        if($cachedData === null){
            $result = DB::table('admin_dashboard_view')->first();
            $result = $result;
            dispatch((new AdminDashboardCacheJob($cacheKey, $result)));
        }

        return (array) $result;
    }

    public function changeUserStatus(int $userId, bool $status): bool | User
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
