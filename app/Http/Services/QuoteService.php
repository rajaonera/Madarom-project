<?php

namespace App\Http\Services;

use App\Models\Quote;
use App\Models\QuoteRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Scalar\String_;

class QuoteService
{
    private const STATUS_PENDING = 'pending';
    private const STATUS_VALIDATED = 'validated';

    private const STATUS_COMMAND = 'command';
    private const ROLE_ADMIN = 'admin';
    private const ROLE_USER = 'user';
    private const STATUS_DELIVERED = 'delivered';
    private const STATUS_FACTURATION = 'facturation';

    private const STATUS_CANCELED = 'canceled';

    public function getQuotes(int $user_id): array
    {
        return Quote::with('items.product.active_price')
            ->where('user_id', $user_id)->get()
            ->toArray();

    }
    public function getQuotesByStatus(int $user_id, string $status): array
    {
        return Quote::with(
            'items.product.active_price')
            ->where('user_id', $user_id)
            ->where('status', $status)->get()
            ->toArray();
    }
    public function getQuotesByQuoteNumber(string $quote_number): array
    {
        return Quote::with(
            'items.product.active_price')
            ->where('quote_number', $quote_number)->get()
            ->toArray();
    }
    public function getQuotesByQuoteRequest(int $quote_request_id): array
    {
        return Quote::with(
            'items.product.active_price')
            ->where('quote_request_id', $quote_request_id)->get()
            ->toArray();
    }

    public function getQuotesByQuoteRequestAndStatus(int $quote_request_id, string $status): array
    {
        return Quote::with(
            'items.product.active_price')
            ->where('quote_request_id', $quote_request_id)
            ->where('status', $status)->get()
            ->toArray();
    }


    public function getQuote(int $id): Quote
    {
        return Quote::with('items.product.active_price')->find($id);
    }
    public function getQuoteRequest(int $id): QuoteRequest
    {
        return QuoteRequest::with('items.product.active_price')->find($id);
    }
    public function getQuoteRequests(int $user_id): array
    {
        return QuoteRequest::with(
            'items.product.active_price')
            ->where('user_id', $user_id)->get()
            ->toArray();
    }
    public function getQuoteRequestsByStatus(int $user_id, string $status): array
    {
        return QuoteRequest::with(
            'items.product.active_price')
            ->where('user_id', $user_id)
            ->where('status', $status)->get()
            ->toArray();
    }

    protected function generatePdf(QuoteRequest $quoteRequest, Quote $quote): string
    {
        $pdf = Pdf::loadView('pdf.quote', [
            'quoteRequest' => $quoteRequest
        ]);

        $fileName = 'devis_'.$quoteRequest->getId().'.pdf';
        $pdfPath = storage_path('app/public/devis/' . $fileName);

        // Créer le dossier s'il n'existe pas
        Storage::makeDirectory('public/devis');

        $pdf->save($pdfPath);

        return $pdfPath;
    }


    /**
     * @throws \Exception
     */
    public function validateAndGenerateQuote(User $user  , QuoteRequest $quoteRequest, int $days , int $hours): void
    {
        if ($quoteRequest->status === 'validated') {
            throw new \Exception('Cette demande a déjà été validée');
        }
        
        if ($user->getRole() !== 'admin') {
            throw new \Exception('Unauthorized action');
        }
        $quote  =  new Quote();
        $quote->setUser_id($quoteRequest->getUserId());
        $quote->setQuote_request($quoteRequest->getId());        
        $quote->setCreatedAt(now());
        $quote->setUpdatedAt(now());
        $quote->setReference($this->generateQuoteNumber());
        $quote->setNotes($quoteRequest->getNotes());
        $quote->setDay($days);
        $quote->setHours($hours);
        $quote->setStatus(self::STATUS_PENDING);
        $quote->save();
        $quoteRequest->setUpdatedAt(now());
        $quoteRequest->setQuote_number($quote->getReference());
        $quoteRequest->update(['status' => self::STATUS_VALIDATED, 'quote_number' => $quote->getReference()]);
        $quoteRequest->load('items.product.active_price');

        // return  $this->generatePdf($quoteRequest, $quote);

    }

    private function generateQuoteNumber(): string
    {
        $date = now()->format('Ymd');
    
        // Compte le nombre de quotes déjà générés aujourd'hui
        $countToday = Quote::whereDate('created_at', now()->toDateString())->count() + 1;
    
        $number = str_pad((string)$countToday, 4, '0', STR_PAD_LEFT);
    
        return "DEV-{$date}-{$number}";
    }

      /**
     * @throws \Exception
     */
    public function canceledQuote (User $user, Quote $quote): void
    {
        if ($quote->getStatus() == self::STATUS_FACTURATION || $quote->getStatus() == self::STATUS_DELIVERED) {
            throw new \Exception('Cette demande a deja ete facturee');
        }
        if (! $user->getRole() == self::ROLE_ADMIN ) {
            throw new \Exception('Unauthorized action');
        }
        $quote->setStatus(self::STATUS_CANCELED);

        $quote->update(['status' => self::STATUS_CANCELED, 'updated_at' => now()]);
        // $quoteRequest  = QuoteRequest::with('items.product.active_price')->find($quote->getQuote_request());

    }

    /**
     * @throws \Exception
     */
    // public function bon_commande(User $user, Quote $quote): void
    // {
    //     if ($quote->getStatus() == self::STATUS_FACTURATION || $quote->getStatus() == self::STATUS_DELIVERED) {
    //         throw new \Exception('Cette demande a deja ete facturee');
    //     }

    //     $quote->setStatus(self::STATUS_COMMAND);

    //     $quote->update(['status' => self::STATUS_COMMAND, 'updated_at' => now()]);
    //     $quoteRequest  = QuoteRequest::with('items.product.active_price')->find($quote->getQuote_request());

    // }

    /**
     * @throws \Exception
     */
    public function bon_commande(User $user, Quote $quote): void
    {
        if ($quote->getStatus() == self::STATUS_FACTURATION || $quote->getStatus() == self::STATUS_DELIVERED) {
            throw new \Exception('Cette demande a deja ete facturee');
        }

        $orderNumber = $this->generateOrderNumber();

        $quote->setStatus(self::STATUS_COMMAND);
        $quote->setReference($orderNumber);
        $quote->update([
            'status' => self::STATUS_COMMAND,
            'reference' => $orderNumber,
            'updated_at' => now()
        ]);

        $quoteRequest = QuoteRequest::find($quote->getQuote_request());
        if ($quoteRequest) {
            $quoteRequest->setQuote_number($orderNumber);
            $quoteRequest->update([
                'quote_number' => $orderNumber,
                'updated_at' => now()
            ]);
        }
    }

    private function generateOrderNumber(): string
    {
        $date = now()->format('Ymd');
    
        $countToday = Quote::whereDate('created_at', now()->toDateString())->count() + 1;
    
        $number = str_pad((string)$countToday, 4, '0', STR_PAD_LEFT);
    
        return "ORD-{$date}-{$number}";
    }

    /**
     * @throws \Exception
    */
    public function facture(User $user, Quote $quote): void
    {
        if ($quote->getStatus() == self::STATUS_FACTURATION || $quote->getStatus() == self::STATUS_DELIVERED) {
            throw new \Exception('Cette demande a deja ete facturee');
        }

        $invoiceNumber = $this->generateInvoiceNumber();

        $quote->setStatus(self::STATUS_FACTURATION);
        $quote->setReference($invoiceNumber);
        $quote->update([
            'status' => self::STATUS_FACTURATION,
            'reference' => $invoiceNumber,
            'updated_at' => now()
        ]);

        $quote->update(['status' => self::STATUS_FACTURATION, 'updated_at' => now()]);
        $quoteRequest  = QuoteRequest::with('items.product.active_price')->find($quote->getQuote_request());

    }

    private function generateInvoiceNumber(): string
    {
        $date = now()->format('Ymd');
    
        $countToday = Quote::whereDate('created_at', now()->toDateString())->count() + 1;
    
        $number = str_pad((string)$countToday, 4, '0', STR_PAD_LEFT);
    
        return "INV-{$date}-{$number}";
    }
    
}