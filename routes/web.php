<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FiliereController;



// routes des etudiants
Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store'); 
Route::get('/etudiants/{id}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
Route::put('/etudiants/{id}', [EtudiantController::class, 'update'])->name('etudiants.update');
Route::delete('/etudiants/{id}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');

// routes des fillières
Route::get('/fillieres', [FiliereController::class, 'index'])->name('fillieres.index');
Route::get('/fillieres/create', [FiliereController::class, 'create'])->name('fillieres.create');
Route::post('/fillieres', [FiliereController::class, 'store'])->name('fillieres.store');
Route::get('/fillieres/{id}/edit', [FiliereController::class, 'edit'])->name('fillieres.edit');
Route::put('/fillieres/{id}', [FiliereController::class, 'update'])->name('fillieres.update');
Route::delete('/fillieres/{id}', [FiliereController::class, 'destroy'])->name('fillieres.destroy'); 
    

Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
