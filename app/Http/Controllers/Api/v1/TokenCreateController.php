<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\TokenService;
use Illuminate\Http\JsonResponse;

class TokenCreateController extends Controller
{
    public function __construct(private readonly TokenService $tokenService)
    {
    }

    public function __invoke(): JsonResponse
    {
        $token = $this->tokenService->generateToken();

        $this->tokenService->storeTokenInDatabase($token);

        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }
}
