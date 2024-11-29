<?php

namespace App\Services;

use App\Exceptions\TokenExpiredException;
use App\Exceptions\TokenUsedException;
use App\Models\AccessToken;

class TokenService
{
    public function generateToken(): string
    {
        $payload = [
            'created_at' => now(),
            'expires_at' => now()->addMinutes(40),
        ];

        return hash('sha256', json_encode($payload));
    }

    public function storeTokenInDatabase(string $token, int $expiresInMinutes = 40): AccessToken
    {
        return AccessToken::create([
            'token' => $token,
            'expires_at' => now()->addMinutes($expiresInMinutes),
            'is_used' => false,
        ]);
    }

    public function validateToken(string $token): AccessToken
    {
        $accessToken = AccessToken::where('token', $token)->first();

        if ($accessToken->is_used) {
            throw new TokenUsedException();
        }

        if ($accessToken->expires_at->isPast()) {
            throw new TokenExpiredException();
        }

        return $accessToken;
    }

    public function markAsUsed(AccessToken $accessToken): void
    {
        $accessToken->update(['is_used' => true]);
    }
}
