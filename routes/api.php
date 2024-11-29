<?php

use App\Http\Controllers\Api\v1\PositionsListController;
use App\Http\Controllers\Api\v1\TokenCreateController;

Route::prefix('v1')->group(function () {
    Route::get('positions', PositionsListController::class);
    Route::get('token', TokenCreateController::class);
});
