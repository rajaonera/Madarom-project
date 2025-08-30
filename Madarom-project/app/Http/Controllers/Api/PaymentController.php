<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Payment;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'quote_id' => 'required|exists:quote,id',
            'phone_number' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'screenshot' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('screenshot')->store('payments', 'public');

        $payment = Payment::create([
            'user_id' => $request->user()->id,
            'quote_id' => $request->quote_id,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'country' => $request->country,
            'screenshot' => $path,
        ]);

        return response()->json([
            'message' => 'Payment submitted successfully. Awaiting verification.',
            'payment' => $payment,
            'screenshot_url' => asset('storage/' . $path),
        ]);
    }
}

