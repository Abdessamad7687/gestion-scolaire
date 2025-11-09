<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComissionController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\ProfesseurController;

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

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

    // routes des groupes
    Route::get('/groupes', [GroupeController::class, 'index'])->name('groupes.index');
    Route::get('/groupes/create', [GroupeController::class, 'create'])->name('groupes.create');
    Route::post('/groupes', [GroupeController::class, 'store'])->name('groupes.store');
    Route::get('/groupes/{id}/edit', [GroupeController::class, 'edit'])->name('groupes.edit');
    Route::put('/groupes/{id}', [GroupeController::class, 'update'])->name('groupes.update');
    Route::delete('/groupes/{id}', [GroupeController::class, 'destroy'])->name('groupes.destroy');

    // routes des comissions
    Route::get('/comissions', [ComissionController::class, 'index'])->name('comissions.index');
    Route::get('/comissions/create', [ComissionController::class, 'create'])->name('comissions.create');
    Route::post('/comissions', [ComissionController::class, 'store'])->name('comissions.store');
    Route::get('/comissions/{id}/edit', [ComissionController::class, 'edit'])->name('comissions.edit');
    Route::put('/comissions/{id}', [ComissionController::class, 'update'])->name('comissions.update');
    Route::delete('/comissions/{id}', [ComissionController::class, 'destroy'])->name('comissions.destroy');

    // routes des professeurs
    Route::get('/professeurs', [ProfesseurController::class, 'index'])->name('professeurs.index');
    Route::get('/professeurs/create', [ProfesseurController::class, 'create'])->name('professeurs.create');
    Route::post('/professeurs', [ProfesseurController::class, 'store'])->name('professeurs.store');
    Route::get('/professeurs/{id}/edit', [ProfesseurController::class, 'edit'])->name('professeurs.edit');
    Route::put('/professeurs/{id}', [ProfesseurController::class, 'update'])->name('professeurs.update');
    Route::delete('/professeurs/{id}', [ProfesseurController::class, 'destroy'])->name('professeurs.destroy');

    // routes des matieres
    Route::get('/matieres', [MatiereController::class, 'index'])->name('matieres.index');
    Route::get('/matieres/create', [MatiereController::class, 'create'])->name('matieres.create');
    Route::post('/matieres', [MatiereController::class, 'store'])->name('matieres.store');
    Route::get('/matieres/{id}/edit', [MatiereController::class, 'edit'])->name('matieres.edit');
    Route::put('/matieres/{id}', [MatiereController::class, 'update'])->name('matieres.update');
    Route::delete('/matieres/{id}', [MatiereController::class, 'destroy'])->name('matieres.destroy');

    // routes des niveaux
    Route::get('/niveaux', [NiveauController::class, 'index'])->name('niveaux.index');
    Route::get('/niveaux/create', [NiveauController::class, 'create'])->name('niveaux.create');
    Route::post('/niveaux', [NiveauController::class, 'store'])->name('niveaux.store');
    Route::get('/niveaux/{id}/edit', [NiveauController::class, 'edit'])->name('niveaux.edit');
    Route::put('/niveaux/{id}', [NiveauController::class, 'update'])->name('niveaux.update');
    Route::delete('/niveaux/{id}', [NiveauController::class, 'destroy'])->name('niveaux.destroy');
});
