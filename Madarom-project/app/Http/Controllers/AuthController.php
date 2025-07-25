<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }

    public function login(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if (Ratelimiter::tooManyAttemps($this -> throttleKey($request),5)){
            return response()->json(['message' => 'Too many login attemps. please try again later. '], 429);
        }

        $user  = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            RateLimiter::hit($this -> throttleKey($request), 60);
//            nombre de bloquage progressive aappres erreur
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        RateLimiter::clear($this -> throttleKey($request));

        $token = $user -> createToken('api_token')->plainTextToken;
        $request -> session()->regenerate();


        $request -> session() -> put('user' , $user);
        $request -> session() -> put('last_url' , url() -> previous());
        $request -> session() -> put('language' , 'en');
        $request -> session() -> put('cart' , $request->session() -> get('cart') , []);
        $request -> session() -> save();

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

        $token = $user -> createToken('myapptoken')->plainTextToken;
        auth()->login($user);

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public  function logout(Request $request): JsonResponse
    {
        $request -> user()->currentAccessToken()->delete();
        $request -> session()->invalidate();
        $request -> session()->regenerateToken();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

