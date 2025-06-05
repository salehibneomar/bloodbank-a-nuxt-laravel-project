<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Donor;

class DonorService
{
    public function getAll(Request $request): LengthAwarePaginator
    {
        $params = $request->all();
        $perPage = $params['per_page'] ?? 7000;
        $page = $params['page'] ?? 1;
        $cacheKey = "donors:page:{$page}:per_page:{$perPage}";
        $totalKey = "donors:total";

        $data = cache()->get($cacheKey);
        $total = cache()->get($totalKey);

        if ($data === null) {
            $data = Donor::forPage($page, $perPage)->get()->toArray();
            cache()->put($cacheKey, $data, 600);
        }
        if ($total === null) {
            $total = Donor::count();
            cache()->put($totalKey, $total, 600);
        }

        return new LengthAwarePaginator(
            $data,
            $total,
            $perPage,
            $page
        );
    }
}
