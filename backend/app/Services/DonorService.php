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
use App\Jobs\CacheDonorListJob;
use App\Jobs\InvalidateDonorCacheJob;
use App\Enums\DonorCache;

class DonorService
{
    public function getAll(Request $request): LengthAwarePaginator
    {
        $params = $request->all();
        $perPage = $params['per_page'] ?? 20;
        $page = $params['page'] ?? 1;
        $listKey = "donors:view:page:{$page}:per_page:{$perPage}";
        $totalKey = "donors:view:total";
        $commonTag = DonorCache::LIST_TAG->value;

        $data = cache()->tags([$commonTag])->get($listKey);
        $total = cache()->tags([$commonTag])->get($totalKey);

        if ($data === null || $total === null) {
            $data = DB::table('donor_view')
                ->forPage($page, $perPage)
                ->get()
                ->toArray();
            $total = DB::table('donor_view')->count();

            dispatch(new CacheDonorListJob($listKey, $totalKey, $data, $total));
        }

        return new LengthAwarePaginator(
            $data,
            $total,
            $perPage,
            $page
        );
    }

    public function getDonorInformationByDonorId(int $id) : array
    {
        $donorInformation = User::with('donorInformation')
        ->select('id', 'name', 'email', 'phone', 'created_at')
        ->where('id', $id)
        ->where('role', UserRole::Donor->value)
        ->where('is_active', true)
        ->firstOrFail();

        $userArray = $donorInformation->toArray();
        $donorInfoArray = $userArray['donor_information'] ?? [];
        unset($userArray['donor_information']);

        if(!empty($donorInfoArray)) {
            unset($donorInfoArray['user_id']);
        }

        $flatDonorInfo = array_merge($userArray, $donorInfoArray);

        return $flatDonorInfo;
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
        dispatch((new InvalidateDonorCacheJob())->delay(now()->addMilliseconds(300)));

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
        dispatch((new InvalidateDonorCacheJob())->delay(now()->addMilliseconds(300)));

        return $user;
    }
}
