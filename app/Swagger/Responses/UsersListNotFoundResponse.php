<?php

namespace App\Swagger\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Users List Not Found Response',
    type: 'object',
    properties: [
        new OA\Property(property: 'success', type: 'boolean', example: false, description: 'Boolean to detect, was request successfully or not'),
        new OA\Property(property: 'message', type: 'string', example: 'Page not found', description: 'Error or success message'),
    ]
)]
class UsersListNotFoundResponse
{

}
