<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\QuoteRequestService;
<<<<<<< Updated upstream:Madarom-project/app/Http/Controllers/Api/QuoteController.php
use App\Http\Services\QuoteService;
use App\Models\Quote;
use App\Models\QuoteRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
=======
use App\Models\QuoteRequest;
use Exception;
use Illuminate\Http\Request;
use App\Http\Services\ApiSessionService;
use App\Http\Services\QuoteService;
use App\Models\Quote;
use App\Notifications\NewOrderNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotificationMail;
use App\Models\Payment;
>>>>>>> Stashed changes:app/Http/Controllers/Api/QuoteController.php

class QuoteController extends Controller
{
    protected QuoteRequestService $quoteRequestService;
<<<<<<< Updated upstream:Madarom-project/app/Http/Controllers/Api/QuoteController.php
    protected QuoteService $quoteService;

    public function __construct(QuoteRequestService $quoteRequestService, QuoteService $quoteService)
    {
        $this->quoteRequestService = $quoteRequestService;
        $this->quoteService = $quoteService;
    }
    public function store(Request $request): \Illuminate\Http\JsonResponse
=======

    protected QuoteService $quoteService;

    public function __construct(QuoteService $quoteService, QuoteRequestService $quoteRequestService)
    {
        $this->quoteService = $quoteService;
        $this->quoteRequestService = $quoteRequestService;
    }
    
    public function store(Request $request)
>>>>>>> Stashed changes:app/Http/Controllers/Api/QuoteController.php
    {
        $user  = $request->user();

        try {
            $quote = $this->quoteRequestService->createQuoteRequest(
                $user->id,
                $request->input('notes')
            );
<<<<<<< Updated upstream:Madarom-project/app/Http/Controllers/Api/QuoteController.php
            return response()->json([
                'message' => 'demande de devis envoyee',
                'quoteRequest_id' => $quote->user()->id
            ]);
=======

            $admin = User::where('role', 'admin')->first();
            $admin->notify(new NewOrderNotification($quote));
            
            return response()->json([
                'message' => 'demande de devis envoyee',
                'quoteRequest_id' => $quote->user->id
            ]);
            
>>>>>>> Stashed changes:app/Http/Controllers/Api/QuoteController.php
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * @throws Exception
     */
<<<<<<< Updated upstream:Madarom-project/app/Http/Controllers/Api/QuoteController.php
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
=======
    // public function index(Request $request): void
    // {
    //     $user  = $request->user();
    //     if (!$user->role == 'admin') {
    //         throw new \Exception('Unauthorized');
    //     }
    // }

    public function index(Request $request)

    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json(['message' => 'Utilisateur non authentifié'], 401);
            }
    
            // Seuls les administrateurs sont autorisés
            if ($user->role !== 'admin') {
                return response()->json(['error' => 'Non autorisé'], 403);
            }
    
            // Récupérer tous les devis avec les relations nécessaires
            $quotes = QuoteRequest::with('items.product.activePrice', 'quote', 'user')->get();
    
            return response()->json($quotes);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération des devis : ' . $e->getMessage());
            return response()->json(['message' => 'Erreur serveur'], 500);
        }
    }
    

    /**
     * @throws Exception
     */
    public function validateQuoteRequest(Request $request ):\Illuminate\Http\JsonResponse
    {
        try {
            $user  = $request->user();
            if ($user->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
    
            if ($request->get('days') < 0 || $request->get('hours') < 0) {
                return response()->json(['error' => 'hours or days cannot be negative'], 400);
            }
    
            // Récupération de la demande de devis
            $quoteRequest = QuoteRequest::with('user')
                ->find($request->get('quote_request_id'));
    
            if (!$quoteRequest) {
                return response()->json(['error' => 'demande de devis inexistant'], 400);
            }
                
            $this->quoteService
                ->validateAndGenerateQuote($user, $quoteRequest, $request->get('days'), $request->get('hours'));

            $userCust = User::find($quoteRequest->user_id);

            if ($userCust) {
                $emailName = strstr($userCust->email, '@', true);
            
                Mail::to($userCust->email)->send(new UserNotificationMail(
                    'Your Quote is Ready / Votre devis est prêt',
                    "
                    <p>Hello {$emailName},</p>
                    <p>Your quote request has been successfully approved. Please check your quote on Mad’arom:</p>
                    <p><a href='https://site-madarom-en.vercel.app/signin' target='_blank'>View your quote / Veuillez consulter votre devis</a></p>
                    <hr>
                    <p>Bonjour {$emailName},</p>
                    <p>Votre demande de devis a été validée avec succès. Vous pouvez consulter votre devis sur Mad’arom :</p>
                    <p><a href='https://site-madarom-en.vercel.app/signin' target='_blank'>Voir votre devis / View your quote</a></p>
                    "
                ));
            } else {
                // Optionnel : log ou gestion si l'utilisateur n'existe pas
                \Log::warning("Utilisateur avec ID {$quoteRequest->user_id} non trouvé pour envoi du mail.");
            }
            
                
            return response()->json([
                'message' => 'Quote successfully validated.'
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Error in validateQuoteRequest: ' . $e->getMessage());
            return response()->json([
                'error' => 'Internal Server Error',
                'details' => $e->getMessage()

            ], 500);
        }
    }

    public function getUserQuotes(Request $request) 
    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json(['message' => 'Utilisateur non authentifié'], 401);
            }
    
            $sessionData = ApiSessionService::get($user->id);
    
            if (!$sessionData || !isset($sessionData['userId'])) {
                return response()->json(['message' => 'Données de session invalides'], 403);
            }
    
            $sessionUserId = $sessionData['userId'];
    
            if ($user->role === 'admin' || $user->id !== $sessionUserId) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $quotes = QuoteRequest::with('items.product.activePrice', 'quote')
                        ->where('user_id', $sessionUserId)
                        ->where('status', 'validated') 
                        ->get();
    
            return response()->json($quotes);
    
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération des devis utilisateur : ' . $e->getMessage());
            return response()->json(['message' => 'Erreur serveur'], 500);
        }
    }
    
    
    public function findQuoteById($id)
    {
        try {
            $quote = QuoteRequest::with(['user', 'items.product.activePrice', 'quote.payment'])->find($id);
    
            if (!$quote) {
                return response()->json(['error' => 'Devis introuvable'], 404);
            }
    
            return response()->json($quote);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération du devis : ' . $e->getMessage());
            return response()->json(['message' => 'Erreur serveur'], 500);
        }
    }
    

     /**
     * @throws Exception
     */
    public function cancelQuote(Request $request, int $idQuote): \Illuminate\Http\JsonResponse
    {
        $quote = Quote::findOrFail($idQuote);
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 401);
        }

        $sessionData = ApiSessionService::get($user->id);
        if (!$sessionData || !isset($sessionData['userId'])) {
            return response()->json(['message' => 'Données de session invalides'], 403);
        }
>>>>>>> Stashed changes:app/Http/Controllers/Api/QuoteController.php
        $this->quoteService->canceledQuote($user, $quote);

        return response()->json([
            'message' => 'Devis annule.',
<<<<<<< Updated upstream:Madarom-project/app/Http/Controllers/Api/QuoteController.php
//            'pdf_url' => asset('storage/devis/' . basename($pdfPath))
=======
>>>>>>> Stashed changes:app/Http/Controllers/Api/QuoteController.php
        ]);
    }

    /**
     * @throws Exception
     */
<<<<<<< Updated upstream:Madarom-project/app/Http/Controllers/Api/QuoteController.php
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
=======
    public function bon_commande(Request $request, int $idQuote): \Illuminate\Http\JsonResponse
    {
        try {
            $quote = Quote::findOrFail($idQuote);
            $user = $request->user();
            if (!$user) {
                return response()->json(['message' => 'Utilisateur non authentifié'], 401);
            }

            $sessionData = ApiSessionService::get($user->id);
            if (!$sessionData || !isset($sessionData['userId'])) {
                return response()->json(['message' => 'Données de session invalides'], 403);
            }

            $this->quoteService->bon_commande($user, $quote);

            return response()->json([
                'message' => 'Bon de commande généré avec succès.',
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération du devis : ' . $e->getMessage());
        
            return response()->json([
                'message' => $e->getMessage(), 
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => config('app.debug') ? $e->getTrace() : null
            ], 500);
        }
        
    }

    public function payment(Request $request)
    {
        $validated = $request->validate([
            'quote_id' => 'required|exists:quote,id',
            'phone_number' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'screenshot' => 'required|string', 
        ]);

        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 401);
        }

        $imageData = base64_decode($validated['screenshot']);
        $imageName = uniqid() . '.png';
        $path = 'payments/' . $imageName;

        \Storage::disk('public')->put($path, $imageData);

        $payment = Payment::create([
            'user_id'      => $user->id,
            'quote_id'     => $validated['quote_id'],
            'phone_number' => $validated['phone_number'],
            'city'         => $validated['city'],
            'country'      => $validated['country'],
            'screenshot'   => $path,
        ]);

        return response()->json([
            'message' => 'Payment submitted successfully. Awaiting verification.',
            'payment' => $payment,
            'screenshot_url' => asset('storage/' . $path),
        ]);
    }

    
    


    /**
     * @throws Exception
     */
    public function facture(Request $request, int $idQuote): \Illuminate\Http\JsonResponse
    {
        $quote = Quote::findOrFail($idQuote);
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 401);
        }

        $sessionData = ApiSessionService::get($user->id);
        if (!$sessionData || !isset($sessionData['userId'])) {
            return response()->json(['message' => 'Données de session invalides'], 403);
        }
        
>>>>>>> Stashed changes:app/Http/Controllers/Api/QuoteController.php
        $this->quoteService->facture($user, $quote);

        return response()->json([
            'message' => 'Facture généré avec succès.',
<<<<<<< Updated upstream:Madarom-project/app/Http/Controllers/Api/QuoteController.php
//            'pdf_url' => asset('storage/devis/' . basename($pdfPath))
=======
>>>>>>> Stashed changes:app/Http/Controllers/Api/QuoteController.php
        ]);
    }
}
