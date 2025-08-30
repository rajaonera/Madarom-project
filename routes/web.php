<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotificationMail;

Route::get('/test-mail', function () {
    $email = 'graciaandriamihamina@gmail.com'; 
    Mail::to($email)->send(new UserNotificationMail(
        'Test Email',
        'Ceci est un test pour vérifier que l’envoi d’email fonctionne.'
    ));
    return 'Email envoyé ! Vérifie ta boîte de réception.';
});

