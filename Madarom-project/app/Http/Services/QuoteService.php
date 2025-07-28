<?php

namespace App\Http\Services;

use App\Models\QuoteRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class QuoteService
{
    protected function generatePdf(QuoteRequest $quoteRequest): string
    {
        $pdf = Pdf::loadView('pdf.quote', [
            'quoteRequest' => $quoteRequest
        ]);

        $fileName = 'devis_'.$quoteRequest->id.'.pdf';
        $pdfPath = storage_path('app/public/devis/' . $fileName);

        // Créer le dossier s'il n'existe pas
        Storage::makeDirectory('public/devis');

        $pdf->save($pdfPath);

        return $pdfPath;
    }

    /**
     * @throws \Exception
     */
    public function validateAndGenerateQuote(QuoteRequest $quoteRequest): string
    {
        if($quoteRequest->is_validated())
        {
            throw new \Exception('Cette demande a deja ete valide');
        }

        $quoteRequest->update(['status' => 'validated']);

        $quoteRequest->load('items.product.active_price');

        return  $this->generatePdf($quoteRequest);

    }

    private function generateQuoteNumber(): string
    {
        $date = now()->format('Ymd');

        $countToday = QuoteRequest::whereDate('created_at',now()->toDateString())->count()+1;

        $number  = str_pad((string)$countToday, 4, '0', STR_PAD_LEFT);

        return "DEV-{$date}-{$number}";
    }
}
