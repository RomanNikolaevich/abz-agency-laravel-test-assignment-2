<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserShowRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserShowRepository;
use Illuminate\Http\JsonResponse;

class UserShowController extends Controller
{
    public function __construct(private readonly UserShowRepository $userShow)
    {
    }

    public function __invoke(UserShowRequest $request): JsonResponse
    {
        try {
            $user = $this->userShow->getUserById($request);

            return response()->json([
                'success' => true,
                'user' => new UserResource($user),
            ], 200);
        } catch (UserNotFoundException $e) {
            return $e->render();
        }
    }

}

