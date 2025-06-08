<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OperationControlMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();
        if ($user && (empty($roles) || in_array($user->role, $roles))) {
            return $next($request);
        }

        throw new \Illuminate\Auth\AuthenticationException();
    }
}
