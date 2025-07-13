<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setup-storage-link', function () {
    Artisan::call('storage:link');
    return 'Lien symbolique storage/public créé avec succès.';
});
