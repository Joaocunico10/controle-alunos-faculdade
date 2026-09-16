<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessorController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('professores', ProfessorController::class);