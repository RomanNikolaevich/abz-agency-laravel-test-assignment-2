<?php

namespace App\Swagger\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Users List Validation Failed Response',
    type: 'object',
    properties: [
        new OA\Property(
            property: 'success',
            type: 'boolean',
            example: false,
            description: 'Boolean to detect, was request successfully or not'
        ),
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'Validation failed',
            description: 'Error or success message'
        ),
        new OA\Property(
            property: 'fails',
            type: 'object',
            description: 'Object that describes errors by field',
            properties: [
                new OA\Property(
                    property: 'count',
                    type: 'array',
                    description: 'Description of error occurred with the count field',
                    items: new OA\Items(type: 'string', example: 'The count must be an integer.')
                ),
                new OA\Property(
                    property: 'page',
                    type: 'array',
                    description: 'Description of error occurred with the page field',
                    items: new OA\Items(type: 'string', example: 'The page must be at least 1.')
                ),
            ]
        ),
    ]
)]
class UsersListValidationFailedResponse
{

}
