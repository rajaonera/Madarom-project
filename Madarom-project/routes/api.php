<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

Route::prefix('products')->group(function () {
    Route::middleware('throttle:60,1')->get('/', [ProductController::class, 'index']);
    Route::middleware('throttle:60,1')->get('/{id}', [ProductController::class, 'show']);
});
