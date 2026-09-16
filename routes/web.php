<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\DisciplinaController;

Route::get('/usuarios', [UserManagementController::class, 'index'])
    ->middleware(['auth', 'role:admin']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('cursos', CursoController::class);
    Route::resource('alunos', AlunoController::class);
});

Route::resource('professores', ProfessorController::class);
Route::resource('disciplinas', DisciplinaController::class);

require __DIR__.'/auth.php';
