<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponserTrait;
use App\Services\DonorService;
use App\Http\Requests\DonorRequest;
use \Exception;
use App\Enums\HttpStatus;
use Illuminate\Support\Facades\Auth;
use App\Jobs\InvalidateDonorCacheJob;
use App\Enums\CrudStatus;

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

    public function register(DonorRequest $request)
    {
        try{
            $donor = $this->donorService->register($request->validated());
            return $this->singleModelResponse($donor, HttpStatus::CREATED, 'Registion successful');
        }
        catch (Exception $e) {
            return $this->errorResponse($e);
        }
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
    public function update(DonorRequest $request)
    {
        $donorId = Auth::user()->id;
        $data = $request->except(['is_active', 'role']);

        try {
            $user = $this->donorService->update($data, $donorId);
            //dispatch(new InvalidateDonorCacheJob());
            return $this->singleModelResponse($user, HttpStatus::OK, CrudStatus::UPDATED->value);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ...existing code for deleting donor...
        dispatch(new InvalidateDonorCacheJob());
        // ...existing code...
    }



}
