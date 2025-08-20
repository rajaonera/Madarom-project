<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\QuoteRequestService;
use App\Http\Services\QuoteService;
use App\Models\Quote;
use App\Models\QuoteRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuoteController extends Controller
{
    protected QuoteRequestService $quoteRequestService;
    protected QuoteService $quoteService;

    public function __construct(QuoteRequestService $quoteRequestService, QuoteService $quoteService)
    {
        $this->quoteRequestService = $quoteRequestService;
        $this->quoteService = $quoteService;
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
    public function validateQuoteRequest(int $id, int $days, int $hours): \Illuminate\Http\JsonResponse
    {
        $quoteRequest = QuoteRequest::with('user', 'items.product.activePrice')->findOrFail($id);
        $user  = Session::get('user');
         $this->quoteService->validateAndGenerateQuote($user, $quoteRequest, $days, $hours);

        return response()->json([
            'message' => 'Devis généré avec succès.',
//            'pdf_url' => asset('storage/devis/' . basename($pdfPath))
        ]);
    }

    /**
     * @throws Exception
     */
    public function cancelQuote(int $idQuote): \Illuminate\Http\JsonResponse
    {
        $quote = Quote::findOrFail($idQuote);
        $user  = Session::get('user');
        $this->quoteService->canceledQuote($user, $quote);

        return response()->json([
            'message' => 'Devis annule.',
//            'pdf_url' => asset('storage/devis/' . basename($pdfPath))
        ]);
    }

    /**
     * @throws Exception
     */
    public function bon_commande(int $idQuote): \Illuminate\Http\JsonResponse
    {
        $quote = Quote::findOrFail($idQuote);
        $user  = Session::get('user');
         $this->quoteService->bon_commande($user, $quote);

        return response()->json([
            'message' => 'Bon de commande généré avec succès.',
//            'pdf_url' => asset('storage/devis/' . basename($pdfPath))
        ]);
    }

    /**
     * @throws Exception
     */
    public function facture(int $idQuote): \Illuminate\Http\JsonResponse
    {
        $quote = Quote::findOrFail($idQuote);
        $user  = Session::get('user');
        $this->quoteService->facture($user, $quote);

        return response()->json([
            'message' => 'Facture généré avec succès.',
//            'pdf_url' => asset('storage/devis/' . basename($pdfPath))
        ]);
    }
}
