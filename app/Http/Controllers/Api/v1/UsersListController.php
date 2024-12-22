<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersListRequest;
use App\Repositories\UsersListRepository;
use App\Responses\UsersListResponse;
use App\Swagger\Responses\UsersListNotFoundResponse;
use App\Swagger\Responses\UsersListSuccessResponse;
use App\Swagger\Responses\UsersListValidationFailedResponse;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class UsersListController extends Controller
{

    public function __construct(private readonly UsersListRepository $usersList)
    {
    }

    #[OA\Get(
        path: '/users',
        summary: 'Get a list of users',
        description: <<<TEXT
        ## Returns users data from a database divided into pages and sorted by ID in ascending order.

        - You can specify the parameters such as **count** and **page**, which correspond to the number of users on the page, missing record number, and page number.
        - To navigate through the pages, you can use the links in the server's response: `next_link` to go to the next page and `prev_link` to return to the previous page.
        - If the next or previous page does not exist, the `next_link`/`prev_link` parameter will be set to `null`.
        TEXT,
        tags: ['users'],
        parameters: [
            new OA\QueryParameter(
                name: 'page',
                description: 'Specify the page that you want to retrieve',
                required: false,
                schema: new OA\Schema(type: 'integer', default: 1)
            ),
            new OA\QueryParameter(
                name: 'count',
                description: 'Specify the amount of items that will be retrieved per page',
                required: false,
                schema: new OA\Schema(type: 'integer', default: 5)
            )
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'Success response',
        content: new OA\JsonContent(ref: UsersListSuccessResponse::class)
    )]
    #[OA\Response(
        response: 404,
        description: 'A JSON object containing errors',
        content: new OA\JsonContent(ref: UsersListNotFoundResponse::class)
    )]
    #[OA\Response(
        response: 422,
        description: 'A JSON object containing errors',
        content: new OA\JsonContent(ref: UsersListValidationFailedResponse::class)
    )]
    public function __invoke(UsersListRequest $request): JsonResponse
    {
        $users = $this->usersList->getUsersList($request);


        if ($users->isEmpty()) {
            return UsersListResponse::notFound();
        }

        return UsersListResponse::success($users);
    }
}
