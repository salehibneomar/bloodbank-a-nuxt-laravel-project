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

    public function changeStatus(Request $request, int $userId): JsonResponse
    {
        if (!$request->has('is_active')){
            return $this->errorResponse(new Exception('Status is required'), HttpStatus::UNPROCESSABLE_ENTITY);
        }

        try{
            $user = $this->adminControlService->changeStatus($userId, $request->is_active);
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
