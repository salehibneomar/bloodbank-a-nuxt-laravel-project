<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Traits\ApiResponserTrait;
use App\Services\DonorService;

class DonorController extends Controller
{
    use ApiResponserTrait;
    private DonorService $donorService;

    public function __construct(DonorService $donorService)
    {
        $this->donorService = $donorService;
    }

    public function index(Request $request)
    {
        // Use the service to get all donors with pagination
        $donors = $this->donorService->getAll($request);
        return $this->listDataResponse($donors);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ...existing code for storing donor...
        // Invalidate donor list cache
        $this->invalidateDonorCache();
        // ...existing code...
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ...existing code for updating donor...
        $this->invalidateDonorCache();
        // ...existing code...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ...existing code for deleting donor...
        $this->invalidateDonorCache();
        // ...existing code...
    }

    /**
     * Invalidate donor list and total cache.
     */
    protected function invalidateDonorCache()
    {
        // Remove all paginated donor cache keys and total
        foreach (cache()->getRedis()->keys('donors:page:*') as $key) {
            cache()->forget(str_replace(config('cache.prefix').':', '', $key));
        }
        cache()->forget('donors:total');
    }
}
