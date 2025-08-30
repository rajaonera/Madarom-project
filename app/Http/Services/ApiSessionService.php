<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Cache;

class ApiSessionService
{
    public static function set(string $key, $value): void
    {
        Cache::put($key, $value);
    }
    public static function getCacheKey(string $user_id): ?string
    {
        return 'Api_session'.$user_id;
    }

    public static function store(string $user_id, array $data, int $ttldays = 1 ): void
    {
        Cache::put(self::getCacheKey($user_id), $data,now()->addDays($ttldays) );
    }

    public static  function get($user_id): ?array
    {
        return Cache::get(self::getCacheKey($user_id));
    }

    public static  function update($user_id, array $data): void
    {
        self::store($user_id, $data);
    }

    public static  function forget($user_id): void
    {
        Cache::forget(self::getCacheKey($user_id));
    }

    public static  function update_field($user_id, string $key,string $value): void
    {
        $cacheKey = self::getCacheKey($user_id);
        $session = Cache::get($cacheKey,[]);

        $session[$key] = $value;

        Cache::put($cacheKey, $session,now()->addDay() );
    }

    public static function addToCart(string $user_id, int $productId, int $quantity): void
    {
        $cacheKey = self::getCacheKey($user_id);
        $session = Cache::get($cacheKey, []);

        $cart = $session['cart'] ?? [];

        $found = false;
        foreach ($cart as &$item) {
            if ($item['product_id'] === $productId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
            ];
        }

        $session['cart'] = $cart;

        Cache::put($cacheKey, $session, now()->addDay());
    }public static function removeFromCart(string $user_id, int $productId): void
{
    $cacheKey = self::getCacheKey($user_id);
    $session = Cache::get($cacheKey, []);

    $cart = $session['cart'] ?? [];

    $cart = array_filter($cart, fn ($item) => $item['product_id'] !== $productId);

    $session['cart'] = array_values($cart);

    Cache::put($cacheKey, $session, now()->addDays(7));
}
public static function updateCartQuantity(string $user_id, int $productId, int $newQuantity): void
{
    $cacheKey = self::getCacheKey($user_id);
    $session = Cache::get($cacheKey, []);

    $cart = $session['cart'] ?? [];

    foreach ($cart as &$item) {
        if ($item['product_id'] === $productId) {
            $item['quantity'] = $newQuantity;
            break;
        }
    }

    $session['cart'] = $cart;

    Cache::put($cacheKey, $session, now()->addDays(7));
}
public static function clearCart(string $user_id): void
{
    $cacheKey = self::getCacheKey($user_id);
    $session = Cache::get($cacheKey, []);

    $session['cart'] = [];

    Cache::put($cacheKey, $session, now()->addDays(7));
}
public static function getCart(string $user_id): array
{
    $cacheKey = self::getCacheKey($user_id);
    $session = Cache::get($cacheKey, []);

    return $session['cart'] ?? [];
}

    public static function get_language($id)
    {
        $cacheKey = self::getCacheKey($id);
        $session  = Cache::get($cacheKey,[]);

        return $session['language'] ?? 'en';
    }

    public static function get_lastUrl($user_id)
    {
        $cacheKey = self::getCacheKey($user_id);
        $session  = Cache::get($cacheKey,[]);

        return $session['last_url'] ?? '/';
    }

    public static function set_lastUrl($user_id, $new_url): void
    {
        self::update_field($user_id,'last_url',$new_url);
    }

}
