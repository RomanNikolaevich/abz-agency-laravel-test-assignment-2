<?php

use App\Http\Controllers\Api\v1\PositionsListController;
use App\Http\Controllers\Api\v1\TokenCreateController;
use App\Http\Controllers\Api\v1\UserCreateController;
use App\Http\Controllers\Api\v1\UserShowController;
use App\Http\Controllers\Api\v1\UsersListController;
use App\Http\Middleware\ValidateToken;

Route::prefix('v1')->group(function () {
    Route::get('users', UsersListController::class);
    Route::get('users/{id}', UserShowController::class);
    Route::post('users', UserCreateController::class)->middleware(ValidateToken::class);
    Route::get('positions', PositionsListController::class);
    Route::get('token', TokenCreateController::class);
});
