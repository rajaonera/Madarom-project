<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    // Définir comment envoyer la notification
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    // Email
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Nouvelle demande sur Mad’arom')
                    ->line("Une nouvelle demande a été faite par {$this->order->user->email}.")
                    ->line("Type : {$this->order->type}") // devis ou commande
                    ->action('Voir la demande', url("https://site-madarom-en.vercel.app/admin/quote/show?ref={$this->order->id}"))
                    ->line('Merci de vérifier la demande rapidement.');
    }

    // Base de données
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'user_name' => $this->order->user->email,
            'type' => $this->order->type,
            'message' => "Nouvelle demande de {$this->order->type} par {$this->order->user->name}.",
        ];
    }
}
