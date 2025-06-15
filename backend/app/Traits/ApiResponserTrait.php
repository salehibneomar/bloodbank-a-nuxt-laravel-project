<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Model;
use App\Enums\HttpStatus;
use \Exception;

trait ApiResponserTrait
{
    private function formatResponse($status, $response = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'data' => $response,
        ], $status['code']);
    }

    private function getModelName(Model $data): string
    {
        return class_basename($data);
    }

    protected function singleModelResponse(Model | array $data, HttpStatus $status = HttpStatus::OK, ?string $customMessage = null): JsonResponse
    {

        return $this->formatResponse(
            [
                'code' => $status->value,
                'name' => $status->name,
                'message' => $customMessage ?? $status->message(),
            ],
            $data,
        );
    }

    protected function listDataResponse(LengthAwarePaginator $list, HttpStatus $status = HttpStatus::OK): JsonResponse
    {
        return $this->formatResponse(
            [
                'code' => $status->value,
                'name' => $status->name,
            ],
            $list,
        );
    }

    protected function errorResponse(Exception $e, HttpStatus $status = HttpStatus::INTERNAL_SERVER_ERROR, ?string $customMessage = null): JsonResponse
    {
        $debug = config('app.debug');
        $statusArr = [
            'code' => $status->value,
            'message' => $customMessage ?? $e->getMessage(),
            'status_message' => $status->message()
        ];
        if ($debug) {
            $statusArr['trace'] = basename($e->getFile()) . ': ' . $e->getLine();
        }
        return response()->json([
            'status' => $statusArr,
        ], $status->value);
    }
}
