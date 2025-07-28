<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\QuoteRequest;
use App\Models\QuoteRequestItem;
use App\notifications\QuoteRequestNotification;
use Exception;
use Illuminate\Support\Facades\Cache;

class QuoteRequestService
{


//    devis venant du panier dans la cache
    /**
     * @throws Exception
     */
    public function createQuoteRequest(int $user_id, ?string $note = null): QuoteRequest
    {
        $cart = ApiSessionService::getCart($user_id);

        if (empty($cart)) {
            throw new Exception("votre panier est vide. Veuillez le remplir.");
        }
        $quote = QuoteRequest::create([
            'user_id' => $user_id,
            'status' => 'pending',
            'notes' => $note,
        ]);

        foreach ($cart as $item) {
            $product = Product::with('prices')->find($item['product_id']);
            if (!$product) {
                throw new Exception("Le produit n'existe pas.");
            }

//            $price = $product::with('prices')->find($item['product_id']);
//            if ($product->active_price){
//                $price = $price->active_price->amount;
//            }

            $price = $product->prices()
                ->where('is_active', true)
                ->orderBy('effective_date', 'desc')
                ->first();

            QuoteRequestItem::create([
                'quote_request_id' => $quote->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price_snapshot' => $price?->amount ?? 0
            ]);
        }

//        Notification admin
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new QuoteRequestNotification($quote));
        }

//        Notification::route('mail', '<EMAIL>')->notify(new QuoteRequestNotification($quote));

//        panier vide
        Cache::forget('cart_' . $user_id);

        return $quote;
    }


}
