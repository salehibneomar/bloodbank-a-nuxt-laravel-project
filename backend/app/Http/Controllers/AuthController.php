<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponserTrait;
use App\Enums\HttpStatus;
use App\Http\Requests\AuthRequest;
use \Exception;
use App\Services\AuthService;

class AuthController extends Controller
{

  use ApiResponserTrait;

  private AuthService $authService;

  public function __construct(AuthService $authService)
  {
    $this->authService = $authService;
  }

  public function login(AuthRequest $request)
  {
    try{
        $response = $this->authService->login($request);
        if (!$response['attempt']) {
            return $this->errorResponse(new Exception('Invalid credentials'), HttpStatus::UNAUTHORIZED);
        }
        $loginData = [
            'token' => $response['token'],
            'user' => $response['user'],
        ];
        return $this->singleModelResponse($loginData, HttpStatus::OK, 'Login successful');
    }
    catch(Exception $e) {
      return $this->errorResponse($e);
    }
  }

  public function logout()
  {
    try {
      $loggedOutUser = $this->authService->logout();
      if (!$loggedOutUser) {
        return $this->errorResponse(new Exception('Logout failed'), HttpStatus::UNAUTHORIZED);
      }
      return $this->singleModelResponse($loggedOutUser, HttpStatus::OK, 'Logout successful');
    } catch (Exception $e) {
      return $this->errorResponse($e);
    }
  }

}
