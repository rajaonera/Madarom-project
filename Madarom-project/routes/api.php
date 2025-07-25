<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

// Api Products
Route::prefix('products')->group(function () {
    Route::middleware('throttle:60,1')->get('/', [ProductController::class, 'index']);
    Route::middleware('throttle:60,1')->get('/{id}', [ProductController::class, 'show']);
});

// API categorie
Route::prefix('categories')->group(function () {
    Route::middleware('throttle:60,1')->get('/', [CategoryController::class, 'index']);
});

// API sous categories
Route::prefix('subcategories')->group(function () {
    Route::middleware('throttle:60,1')->get("/", [SubCategoryController::class, 'index']);
});


// API connexion et inscription
Route::middleware('throttle:60,1')->post('/register', [AuthController::class, 'register']);
//Route::post('/login',[AuthController::class, 'login']);
Route::prefix('users')->group(function () {
    Route::middleware('throttle:60,1')->get("/", function () {
        return response()->json(['message' => 'users is here']);
    });
    Route::middleware('throttle:60,1') ->get("/register", [AuthController::class, 'register']);
    Route::middleware('throttle:60,1') ->get("/login", [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
        return $request->user();
    });

});


// API liste user


// API logout
Route::middleware('auth:sanctum')->post('/logout',[AuthController::class, 'logout']);


