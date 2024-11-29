<?php

namespace App\Http\Middleware;

use App\Exceptions\TokenExpiredException;
use App\Exceptions\TokenUsedException;
use App\Services\TokenService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

readonly class ValidateToken
{
    public function __construct(private TokenService $tokenService)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Token');

        try {
            $accessToken = $this->tokenService->validateToken($token);
            $request->merge(['accessToken' => $accessToken]);
        } catch (TokenUsedException|TokenExpiredException $e) {
            return $e->render();
        }

        return $next($request);
    }
}
