<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponserTrait;
use App\Services\DonorService;
use App\Http\Requests\DonorRequest;
use \Exception;
use App\Enums\HttpStatus;
use Illuminate\Support\Facades\Auth;
use App\Enums\CrudStatus;
use Illuminate\Http\JsonResponse;

class DonorController extends Controller
{
    use ApiResponserTrait;

    private DonorService $donorService;

    public function __construct(DonorService $donorService)
    {
        $this->donorService = $donorService;
    }

    public function index(Request $request) : JsonResponse
    {
        try
        {
        $donors = $this->donorService->getAll($request);
        return $this->listDataResponse($donors);
        }
        catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function showDonorInformation(int $userId) : JsonResponse
    {
        try {
            $donorInformation = $this->donorService->getDonorInformationByDonorId($userId);
            return $this->singleModelResponse($donorInformation, HttpStatus::OK);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse($e, HttpStatus::NOT_FOUND);
        }
        catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function profile() : JsonResponse
    {
        $donorId = Auth::user()->id;
        try {
            $donorInformation = $this->donorService->getDonorInformationByDonorId($donorId);
            return $this->singleModelResponse($donorInformation, HttpStatus::OK);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function register(DonorRequest $request) : JsonResponse
    {
        try{
            $donor = $this->donorService->register($request->validated());
            return $this->singleModelResponse($donor, HttpStatus::CREATED, 'Registion successful');
        }
        catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update(DonorRequest $request) : JsonResponse
    {
        $donorId = Auth::user()->id;
        $data = $request->except(['is_active', 'role']);

        try {
            $user = $this->donorService->update($data, $donorId);
            return $this->singleModelResponse($user, HttpStatus::OK, CrudStatus::UPDATED->value);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }

    }


}
