<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersListRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UsersListRepository;
use Illuminate\Http\JsonResponse;

class UsersListController extends Controller
{

    public function __construct(private readonly UsersListRepository $usersList)
    {
    }

    public function __invoke(UsersListRequest $request): JsonResponse
    {
        $users = $this->usersList->getUsersList($request);

        if ($users->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found',
            ], 404);
        }

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
}
