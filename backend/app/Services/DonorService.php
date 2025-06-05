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
        $donors = Donor::paginate($params['per_page'] ?? 100);
        return $donors;
    }
}
