<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\ApiSessionService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $key = $this->throttleKey($request);
        $maxAttempts = 5;

        // Nombre actuel de tentatives
        $attempts = RateLimiter::attempts($key);

        // Calcul du temps de blocage progressif
        if ($attempts >= $maxAttempts) {
            $delay = ($attempts - $maxAttempts + 1) * 60; // ex: 6e tentative = 60s, 7e = 120s, ...
            RateLimiter::hit($key, $delay);

            return response()->json([
                'message' => "Trop de tentatives. Réessayez dans $delay secondes."
            ], 429);
        }

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            RateLimiter::hit($key); // On incrémente quand même

            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Succès → reset du compteur
        RateLimiter::clear($key);

        $token = $user->createToken('api_token')->plainTextToken;


        ApiSessionService::store($user->id, [
            'userId' => $user->id,
            'language' => 'en',
            'last_url' => url()->previous(),
            'cart' => []
        ]);

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }
    public function register(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $fields['name'] = strip_tags($fields['name']);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('myapp token')->plainTextToken;
        auth()->login($user);

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public  function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out successfully']);
    }

}
