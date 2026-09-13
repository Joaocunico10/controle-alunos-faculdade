<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;

Route::get('/teste-admin', function () {
    return 'Acesso permitido para administrador!';
})->middleware('auth', 'role:admin');

Route::get('/usuarios', [UserManagementController::class, 'index'])
    ->middleware(['auth', 'role:admin']);
