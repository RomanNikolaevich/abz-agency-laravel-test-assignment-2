<?php

namespace App\Swagger\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Users List Success Response',
    type: 'object',
    properties: [
        new OA\Property(property: 'success', type: 'boolean', example: true),
        new OA\Property(property: 'page', type: 'integer', example: 1),
        new OA\Property(property: 'total_pages', type: 'integer', example: 10),
        new OA\Property(property: 'total_users', type: 'integer', example: 47),
        new OA\Property(property: 'count', type: 'integer', example: 5),
        new OA\Property(
            property: 'links',
            type: 'object',
            properties: [
                new OA\Property(property: 'next_link', type: 'string', nullable: true, example: 'https://abz-agency-laravel-test-assignment-2.test/api/v1/users?page=2'),
                new OA\Property(property: 'prev_link', type: 'string', nullable: true, example: null),
            ]
        ),
        new OA\Property(
            property: 'users',
            type: 'array',
            items: new OA\Items(
                type: 'object',
                properties: [
                    new OA\Property(property: 'id', type: 'integer', example: 1),
                    new OA\Property(property: 'name', type: 'string', example: 'Jarvis Brakus'),
                    new OA\Property(property: 'email', type: 'string', example: 'xkautzer@example.org'),
                    new OA\Property(property: 'phone', type: 'string', example: '+380732313740'),
                    new OA\Property(property: 'position_id', type: 'integer', example: 4),
                    new OA\Property(property: 'position', type: 'string', example: 'Freight Inspector'),
                    new OA\Property(property: 'registration_timestamp', type: 'integer', example: 1732842845),
                    new OA\Property(property: 'photo', type: 'string', example: 'images/users/1732842681674914b9034d8.jpg'),
                ]
            ),
            example: [
                [
                    "id" => 30,
                    "name" => "Angel",
                    "email" => "angel.williams@example.com",
                    "phone" => "+380496540023",
                    "position" => "Designer",
                    "position_id" => 4,
                    "registration_timestamp" => 1537777441,
                    "photo" => "https://abz.my-test.website/images/users/5b977ba13fb3330.jpeg",
                ],
                [
                    "id" => 29,
                    "name" => "Mattie",
                    "email" => "mattie.lee@example.com",
                    "phone" => "+380204819073",
                    "position" => "Designer",
                    "position_id" => 4,
                    "registration_timestamp" => 1537691099,
                    "photo" => "https://abz.my-test.website/images/users/5b977ba1245cc29.jpeg",
                ],
                [
                    "id" => 36,
                    "name" => "Joshua",
                    "email" => "joshua.dean@example.com",
                    "phone" => "+380542161925",
                    "position" => "Designer",
                    "position_id" => 4,
                    "registration_timestamp" => 1537661281,
                    "photo" => "https://abz.my-test.website/images/users/5b977ba1e527036.jpeg",
                ],
                [
                    "id" => 37,
                    "name" => "Lisa",
                    "email" => "lisa.medina@example.com",
                    "phone" => "+380564753087",
                    "position" => "Security",
                    "position_id" => 3,
                    "registration_timestamp" => 1537639019,
                    "photo" => "https://abz.my-test.website/images/users/5b977ba20bd9537.jpeg",
                ],
                [
                    "id" => 42,
                    "name" => "Lorraine",
                    "email" => "lorraine.morris@example.com",
                    "phone" => "+380945198009",
                    "position" => "Designer",
                    "position_id" => 4,
                    "registration_timestamp" => 1537629182,
                    "photo" => "https://abz.my-test.website/images/users/5b977ba293d2f42.jpeg",
                ]
            ]
        ),
    ]
)]
class UsersListSuccessResponse
{

}
