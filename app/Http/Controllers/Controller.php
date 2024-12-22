<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Users API',
    description: 'Documentation for the Users API endpoints'
)]
#[OA\Server(
    url: '/api/v1',
    description: 'API v1 Server'
)]
#[OA\SecurityScheme(
    securityScheme: 'tokenAuth',
    type: 'apiKey',
    name: 'Token',
    description: 'Refresh token',
    in: 'header',
)]
abstract class Controller
{
    //
}
