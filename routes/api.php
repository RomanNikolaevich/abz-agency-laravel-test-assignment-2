<?php

use App\Http\Controllers\Api\v1\PositionsListController;

Route::prefix('v1')->group(function () {
    Route::get('positions', PositionsListController::class);
});
