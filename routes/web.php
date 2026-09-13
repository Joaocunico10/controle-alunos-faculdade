<?php

use Illuminate\Support\Facades\Route;

Route::get('/teste-admin', function () {
    return 'Acesso permitido para administrador!';
})->middleware('auth', 'role:admin');
