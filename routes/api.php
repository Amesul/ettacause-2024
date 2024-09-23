<?php

use App\Http\Controllers\Api\StreamerController;
use App\Http\Middleware\ApiMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->name('api.')->middleware(ApiMiddleware::class)->group(function () {
    Route::apiResource('streamers', StreamerController::class, [
        'only' => ['index', 'show'],
    ]);
});
