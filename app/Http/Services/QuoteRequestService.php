<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\QuoteRequest;
use App\Models\QuoteRequestItem;
use App\notifications\QuoteRequestNotification;
use Exception;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use Illuminate\Support\Str;

class QuoteRequestService
{


//    devis venant du panier dans la cache
    /**
     * @throws Exception
     */
    // public function createQuoteRequest(int $user_id, ?string $note = null): QuoteRequest
    // {
    //     $cart = ApiSessionService::getCart($user_id);

    //     if (empty($cart)) {
    //         throw new Exception("votre panier est vide. Veuillez le remplir.");
    //     }
    //     $quote = QuoteRequest::create([
    //         'user_id' => $user_id,
    //         'status' => 'pending',
    //         'notes' => $note,
    //     ]);

    //     foreach ($cart as $item) {
    //         $product = Product::with('prices')->find($item['product_id']);
    //         if (!$product) {
    //             throw new Exception("Le produit n'existe pas.");
    //         }

    //         $price = $product->prices()
    //             ->where('is_active', true)
    //             ->orderBy('effective_date', 'desc')
    //             ->first();

    //         QuoteRequestItem::create([
    //             'quote_request_id' => $quote->id,
    //             'product_id' => $product->id,
    //             'quantity' => $item['quantity'],
    //             'price_snapshot' => $price?->amount ?? 0
    //         ]);
    //     }

    //     $admins = User::where('role', 'admin')->get();

    //     ApiSessionService::clearCart($user_id);


    //     return $quote;
    // }
    
    public function createQuoteRequest(int $user_id, ?string $note = null): QuoteRequest
    {
        $cart = ApiSessionService::getCart($user_id);

        if (empty($cart)) {
            throw new Exception("votre panier est vide. Veuillez le remplir.");
        }

        $quote_number = $this->generateUniqueQuoteNumber();

        $quote = QuoteRequest::create([
            'user_id' => $user_id,
            'status' => 'pending',
            'notes' => $note,
            'quote_number' => $quote_number,
        ]);

        foreach ($cart as $item) {
            $product = Product::with('prices')->find($item['product_id']);
            if (!$product) {
                throw new Exception("Le produit n'existe pas.");
            }

            $price = $product->prices()
                ->where('is_active', true)
                ->orderBy('effective_date', 'desc')
                ->first();

            QuoteRequestItem::create([
                'quote_request_id' => $quote->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price_snapshot' => $price?->amount ?? 0,
                'price_snapshot_mga' => $price?->amount_mga ?? 0
            ]);
        }

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new QuoteRequestNotification($quote));
        }

        ApiSessionService::clearCart($user_id);

        return $quote;
    }

    private function generateUniqueQuoteNumber(): string
    {
        do {
            // Exemple de format : Q20250729-AB12XZ
            $prefix = 'Q' . date('Ymd') . '-';
            $random = strtoupper(Str::random(6));
            $quote_number = $prefix . $random;
        } while (QuoteRequest::where('quote_number', $quote_number)->exists());

        return $quote_number;
    }
}
