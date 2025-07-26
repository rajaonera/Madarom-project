<?php

namespace App\Http\Services;

use App\Http\Controllers\Api\CartController;
use App\Models\QuoteRequest;
use Exception;

class QuoteRequestService
{
//    devis venant du panier dans la cache
    /**
     * @throws Exception
     */
    public function createQuoteRequest(int $user_id, ?string $note = null): QuoteRequest
    {
        $cart  = ApiSessionService::getCart($user_id);

        if (empty($cart)){
            throw new Exception("votre panier est vide. Veuillez le remplir.");
        }
//        $quote = QuoteRequest::create([
//            'user_id'
//        ])
        return QuoteRequest::created();
    }
}
