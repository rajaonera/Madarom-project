<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\ApiSessionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PreferencesUserController extends Controller
{
    public function get_language(Request $request): JsonResponse
    {
        $user = $request->user();
        $preferences = ApiSessionService::get_language($user->id);
        return response()->json($preferences);
    }

    public function set_language(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'language' => 'required|in:fr,en'
        ]);

        $user = $request->user();

        ApiSessionService::update_field($user->id, 'language', $validated['language']);

        return response()->json(['message' => 'Cart updated']);
    }

    public function get_lastUrl(Request $request)
    {
        $user = $request->user();

        return ApiSessionService::get_lastUrl($user->id());
    }

    public function set_lastUrl(Request $request): void
    {
        $validated = $request->validate([
            'last_url' => 'required|string'
        ]);

        $user = $request->user();

        ApiSessionService::set_lastUrl($user->id(),$validated['last_url'] );
    }
}
