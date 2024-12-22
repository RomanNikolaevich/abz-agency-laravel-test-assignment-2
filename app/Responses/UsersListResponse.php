<?php

namespace App\Responses;

use App\Http\Resources\UserResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersListResponse
{
    public static function success(LengthAwarePaginator $users): JsonResponse
    {
        return response()->json([
            'success' => true,
            'page' => $users->currentPage(),
            'total_pages' => $users->lastPage(),
            'total_users' => $users->total(),
            'count' => $users->count(),
            'links' => [
                'next_link' => $users->nextPageUrl(),
                'prev_link' => $users->previousPageUrl(),
            ],
            'users' => UserResource::collection($users)->resolve(),
        ]);
    }

    public static function notFound(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Page not found',
        ], 404);
    }

    public static function validationFailed(Validator $validator): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed.',
            'fails' => $validator->errors(),
        ], 422);
    }
}
