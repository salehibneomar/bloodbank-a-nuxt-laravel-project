<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminControlService;
use App\Enums\CrudStatus;
use App\Traits\ApiResponserTrait;
use Illuminate\Http\JsonResponse;
use \Exception;
use App\Enums\HttpStatus;

class AdminControlController extends Controller
{

    use ApiResponserTrait;

    private AdminControlService $adminControlService;

    public function __construct(AdminControlService $adminControlService)
    {
        $this->adminControlService = $adminControlService;
    }

    public function getDashboardData(): JsonResponse
    {
        try {
            $data = $this->adminControlService->getDashboardData();
            return $this->singleModelResponse($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function changeUserStatus(Request $request, int $userId): JsonResponse
    {
        if (!$request->has('is_active') || !in_array($request->is_active, [0, 1])){
            return $this->errorResponse(new Exception('Status is required'), HttpStatus::UNPROCESSABLE_ENTITY);
        }

        try{
            $user = $this->adminControlService->changeUserStatus($userId, $request->is_active);
            if(!$user) {
                return $this->errorResponse(new Exception('Not Allowed'), HttpStatus::FORBIDDEN);
            }
            return $this->singleModelResponse($user, HttpStatus::OK, CrudStatus::UPDATED->value);
        }
        catch(Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
