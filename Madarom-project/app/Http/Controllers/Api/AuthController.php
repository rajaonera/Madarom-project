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
<<<<<<< Updated upstream:Madarom-project/app/Http/Controllers/Api/AuthController.php
=======
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotificationMail;
>>>>>>> Stashed changes:app/Http/Controllers/Api/AuthController.php

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

<<<<<<< Updated upstream:Madarom-project/app/Http/Controllers/Api/AuthController.php
        // Succès → reset du compteur
=======
>>>>>>> Stashed changes:app/Http/Controllers/Api/AuthController.php
        RateLimiter::clear($key);

        $token = $user->createToken('api_token')->plainTextToken;


        ApiSessionService::store($user->id, [
            'userId' => $user->id,
            'language' => 'en',
            'last_url' => url()->previous(),
            'cart' => []
<<<<<<< Updated upstream:Madarom-project/app/Http/Controllers/Api/AuthController.php
        ]);

        return response()->json([
            'user' => $user,
            'token' => $token
=======
        ]);    
        
        $emailName = strstr($user->email, '@', true); 
        Mail::to($user->email)->send(new UserNotificationMail(
            'Mad’arom Login Notification',
            "Hello {$emailName}, you have successfully logged in to Mad’arom. If this wasn't you, please secure your account immediately."
        ));
        

        return response()->json([
            'user' => $user,
            'token' => $token,
>>>>>>> Stashed changes:app/Http/Controllers/Api/AuthController.php
        ], 201);
    }
    public function register(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
<<<<<<< Updated upstream:Madarom-project/app/Http/Controllers/Api/AuthController.php

        $fields['name'] = strip_tags($fields['name']);

=======
    
        $fields['name'] = strip_tags($fields['name']);
    
>>>>>>> Stashed changes:app/Http/Controllers/Api/AuthController.php
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'role' => 'user'
        ]);
<<<<<<< Updated upstream:Madarom-project/app/Http/Controllers/Api/AuthController.php

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
=======
    
        // Authentifie l'utilisateur
        auth()->login($user);
    
        // Crée le token API
        $token = $user->createToken('api_token')->plainTextToken;
    
        ApiSessionService::store($user->id, [
            'userId' => $user->id,
            'language' => 'en',
            'last_url' => url()->previous(),
            'cart' => []
        ]);

        $emailName = strstr($user->email, '@', true); 
        Mail::to($user->email)->send(new UserNotificationMail(
            'Welcome to Mad’arom',
            "Hello {$emailName}, thank you for registering! We're excited to have you on board."
        ));
    
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }
    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();
    
        if ($user) {
            $user->currentAccessToken()->delete();
    
            \App\Http\Services\ApiSessionService::forget($user->id);
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return response()->json(['message' => 'Logged out successfully']);
    }
    public function getUserFromSession(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json(['message' => 'Utilisateur non authentifié'], 401);
            }

            $sessionData = ApiSessionService::get($user->id);
    
            if (!$sessionData || !isset($sessionData['userId'])) {
                return response()->json(['message' => 'ID utilisateur introuvable dans la session'], 404);
            }
    
            $foundUser = User::find($sessionData['userId']);
    
            if (!$foundUser) {
                return response()->json(['message' => 'Utilisateur non trouvé'], 404);
            }
    
            return response()->json([
                'user' => $foundUser,
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Erreur getUserFromSession: ' . $e->getMessage());
    
            return response()->json(['message' => 'Erreur serveur'], 500);
        }
    }
    
    public function getUserById($id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = \App\Models\User::find($id);

            if (!$user) {
                return response()->json(['message' => 'Utilisateur non trouvé'], 404);
            }

            return response()->json(['user' => $user]);
        } catch (\Exception $e) {
            \Log::error('Erreur getUserById : ' . $e->getMessage());
            return response()->json(['message' => 'Erreur serveur'], 500);
        }
    }


>>>>>>> Stashed changes:app/Http/Controllers/Api/AuthController.php

}
