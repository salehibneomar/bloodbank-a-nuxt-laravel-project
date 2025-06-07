<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use App\Enums\UserRole;
use App\Jobs\DonorInformationJobForQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\DonorInformation;

class DonorService
{
    public function getAll(Request $request): LengthAwarePaginator
    {
        $params = $request->all();
        $perPage = $params['per_page'] ?? 20;
        $page = $params['page'] ?? 1;
        $cacheKey = "donors:view:page:{$page}:per_page:{$perPage}";
        $totalKey = "donors:view:total";

        $data = cache()->remember($cacheKey, 600, function () use ($page, $perPage) {
            return DB::table('donor_view')
                ->forPage($page, $perPage)
                ->get()
                ->toArray();
        });

        $total = cache()->remember($totalKey, 600, function () {
            return DB::table('donor_view')->count();
        });

        return new LengthAwarePaginator(
            $data,
            $total,
            $perPage,
            $page
        );
    }

    public function register(array $data) : User
    {
        extract($data);
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone ?? null;
        $user->password = Hash::make($password);
        $user->role = UserRole::Donor->value;
        $user->save();

        dispatch(new DonorInformationJobForQueue([
            'user_id'     => $user->id,
            'blood_group' => $blood_group,
        ]));

        return $user;
    }

    public function update(array $data, int $userId): User
    {
        $user = User::findOrFail($userId);
        $filteredUserData = Arr::only($data, $user->getFillable());
        if (isset($filteredUserData['password'])) {
            $filteredUserData['password'] = Hash::make($filteredUserData['password']);
        }
        $user->fill($filteredUserData);
        $user->save();
        dispatch(new DonorInformationJobForQueue($data, $user));

        return $user;
    }
}
