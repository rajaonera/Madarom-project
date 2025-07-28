<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PreferencesUserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\QuoteController;

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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

// API gestion de panier
Route::middleware('auth:sanctum')->prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/', [CartController::class, 'add']);
    Route::put('/{product_id}', [CartController::class, 'update']);
    Route::delete('/{product_id}', [CartController::class, 'remove']);
    Route::delete('/', [CartController::class, 'clear']);
});

//  API gestion de preferences
Route::middleware('auth:sanctum')->prefix('preferences')->group(function () {
    Route::get('/lang', [PreferencesUserController::class, 'get_language']);
    Route::post('/lang', [PreferencesUserController::class, 'set_language']);
    Route::get('/url', [PreferencesUserController::class, 'get_lastUrl']);
    Route::post('/url', [PreferencesUserController::class, 'set_lastUrl']);
});

//  API gestion de devis
Route::middleware('auth:sanctum')->prefix('quote')->group(function () {
    Route::get('/', [QuoteController::class, 'index']);
    Route::post('/', [QuoteController::class, 'store']);
});

// API gestion de prix
//Route::middleware('auth:sanctum')->prefix('price')->group(function () {
//    Route::get('/', [QuoteController::class, 'index']);
//    Route::post('/', [QuoteController::class, 'store']);
//});


// API logout
Route::middleware('auth:sanctum')->post('/logout',[AuthController::class, 'logout']);


