<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\ApiSessionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $cart = ApiSessionService::getCart($user->id);
        return response()->json($cart);
    }

    public function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|min:1',
        ]);
        $user = $request->user();

        ApiSessionService::addToCart($user->id, $validated['product_id'], $validated['quantity']);

        return response()->json(['message' => 'Product added to cart']);
    }

    public function update(Request $request, int $productId): JsonResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = $request->user();

        ApiSessionService::updateCartQuantity($user->id, $productId, $validated['quantity']);

        return response()->json(['message' => 'Cart updated']);
    }

    public function remove(Request $request, int $productId): JsonResponse
    {
        $user = $request->user();

        ApiSessionService::removeFromCart($user->id, $productId);
        return response()->json(['message' => 'Product removed from cart']);
    }

    public function clear(Request $request): JsonResponse
    {
        $user = $request->user();
        ApiSessionService::clearCart($user->id);
        return response()->json(['message' => 'Cart cleared']);
    }
}
