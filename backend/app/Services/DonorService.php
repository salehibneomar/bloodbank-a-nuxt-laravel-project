<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use App\Enums\UserRole;

class DonorService
{
    public function getAll(Request $request): LengthAwarePaginator
    {
        $params = $request->all();
        $perPage = $params['per_page'] ?? 20;
        $page = $params['page'] ?? 1;
        $role = UserRole::Donor->value;
        $cacheKey = "donors:page:{$page}:per_page:{$perPage}";
        $totalKey = "donors:total";

        $data = cache()->remember($cacheKey, 600, function () use ($role, $page, $perPage) {
            return User::where('role', $role)
                ->select(['id', 'name', 'email', 'phone', 'is_active'])
                ->forPage($page, $perPage)
                ->get()
                ->toArray();
        });

        $total = cache()->remember($totalKey, 600, function () use ($role) {
            return User::where('role', $role)->count();
        });

        return new LengthAwarePaginator(
            $data,
            $total,
            $perPage,
            $page
        );
    }
}
