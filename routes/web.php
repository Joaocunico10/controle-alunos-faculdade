<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\DisciplinaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('professores', ProfessorController::class);
Route::resource('disciplinas', DisciplinaController::class);