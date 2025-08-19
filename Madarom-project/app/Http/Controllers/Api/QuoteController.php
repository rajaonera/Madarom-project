<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\QuoteRequestService;
use App\Http\Services\QuoteService;
use App\Models\Quote;
use App\Models\QuoteRequest;
use Exception;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    protected QuoteService $quoteService;
    protected QuoteRequestService $quoteRequestService;

    public function __construct(QuoteService $quoteService, QuoteRequestService $quoteRequestService)
    {
        $this->quoteService = $quoteService;
        $this->quoteRequestService = $quoteRequestService;
    }
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user  = $request->user();

        try {
            $quote = $this->quoteRequestService->createQuoteRequest(
                $user->id,
                $request->input('notes')
            );
            return response()->json([
                'message' => 'demande de devis envoyee',
                'quoteRequest_id' => $quote->user()->id
            ]);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * @throws Exception
     */
    public function index(Request $request): void
    {
        $user  = $request->user();
        if (!$user->role == 'admin') {
            throw new \Exception('Unauthorized');
        }
    }

    /**
     * @throws Exception
     */
    public function validateQuoteRequest(Request $request ): \Illuminate\Http\JsonResponse
    {
//        validation des arguments
        $user  = $request->user();
        if ($user->role != 'admin') {
            throw new \Exception('Unauthorized');
        }
        if ($request->get('days') < 0 || $request->get('hours') < 0) {
            return response()->json(['error' => 'hours ou days negatif'], 400);
        }
        print '0';

//        demande de devis avec la liste des produits et prix
        $quoteRequest = QuoteRequest::with('user', 'items.product.activePrice')->find($request->get('quote_request_id'));
        print '1';

        if ($quoteRequest->isEmpty()){
            return response()->json(['error' => 'demande de devis inexistant'], 400);
        }
//        creation d'un pdf
        $pdfPath = $this->quoteService
            ->validateAndGenerateQuote($user,$quoteRequest,$request->get('days'),$request->get('hours'));
        print '4';

//        notification niveau user

//        envoi par email du pdf

//        confirmation niveau admin
        return response()->json([
            'message' => 'Devis généré avec succès.',
            'pdf_url' => asset('storage/devis/' . basename($pdfPath))
        ]);
    }

}
