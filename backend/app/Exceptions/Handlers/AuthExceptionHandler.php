<?php

namespace App\Exceptions\Handlers;

use App\Traits\ApiResponserTrait;
use App\Enums\HttpStatus;

class AuthExceptionHandler
{
    use ApiResponserTrait;

    public function handle(\Exception $exception)
    {
        return $this->errorResponse($exception, HttpStatus::UNAUTHORIZED, $exception->getMessage());
    }
}
