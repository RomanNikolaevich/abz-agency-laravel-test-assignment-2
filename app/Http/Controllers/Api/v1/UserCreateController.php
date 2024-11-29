<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\ImageProcessingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Services\ImageProcessing\ImageProcessorService;
use App\Services\ImageProcessing\Strategies\UploadedImageSourceService;
use App\Services\TokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserCreateController extends Controller
{
    public function __construct(private readonly TokenService $tokenService)
    {
    }

    public function __invoke(UserCreateRequest $request): JsonResponse
    {
        $accessToken = $request->get('accessToken');
        $userStoreData = $request->validated();

        try {
            $imageSource = new UploadedImageSourceService($request->file('photo'));
            $imageProcessor = new ImageProcessorService($imageSource);

            $userStoreData['photo'] = $imageProcessor->processAndStoreImage();
        } catch (ImageProcessingException $e) {
            return $e->render();
        }

        $user = DB::transaction(function () use ($userStoreData, $accessToken) {
            $user = User::create($userStoreData);
            $this->tokenService->markAsUsed($accessToken);

            return $user;
        });

        return response()->json([
            'success' => true,
            'user_id' => $user->id,
            'message' => 'New user successfully registered',
        ], 201);
    }
}
