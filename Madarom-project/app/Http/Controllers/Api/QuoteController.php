<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\QuoteRequestService;
use App\Models\QuoteRequest;
use Exception;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    protected QuoteRequestService $quoteRequestService;

    public function __construct(QuoteRequestService $quoteRequestService)
    {
        $this->quoteRequestService = $quoteRequestService;
    }
    public function store(Request $request)
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
    public function validateQuote(int $id)
    {
        $quoteRequest = QuoteRequest::with('user', 'items.product.activePrice')->findOrFail($id);

        $pdfPath = $this->quoteRequestService->validateAndGenerateQuote($quoteRequest);

        return response()->json([
            'message' => 'Devis généré avec succès.',
            'pdf_url' => asset('storage/devis/' . basename($pdfPath))
        ]);
    }

}
