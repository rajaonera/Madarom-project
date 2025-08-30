<?php

namespace App\notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuoteRequestNotification extends Notification
{
    public function __construct(protected $quoteRequest)
    {

    }
    public function via($notifiable)
    {
//        return ['mail'];
        return ['database'];
    }

    public function toDatabase($notifiable){
        return [
            'quoteRequest_id' => $this->quoteRequest->id,
            'user_id' => $this->quoteRequest->user_id,
            'notes' => $this->quoteRequest->notes,
            'created_at' => now(),
        ];
    }

//    public function toMail($notifiable){
//        return (new MailMessage)
//            ->subject('Nouvelle demande de devis')
//            ->line('Une nouvelle demande de devis a ete envoye par le client : #{$this->quoteRequest->user->email}')
//            ->action('Voir la demande de devis', url('/admin/quote-requests'));
//    }
}
