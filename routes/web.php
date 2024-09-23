<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\MatiereController;

Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store'); 
Route::get('/etudiants/{id}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
Route::put('/etudiants/{id}', [EtudiantController::class, 'update'])->name('etudiants.update');
Route::delete('/etudiants/{id}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
    

Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');



Route::get('/professeurs', [ProfesseurController::class, 'index'])->name('professeurs.index');
Route::get('/professeurs/create', [ProfesseurController::class, 'create'])->name('professeurs.create');
Route::post('/professeurs', [ProfesseurController::class, 'store'])->name('professeurs.store'); 
Route::get('/professeurs/{id}/edit', [ProfesseurController::class, 'edit'])->name('professeurs.edit');
Route::put('/professeurs/{id}', [ProfesseurController::class, 'update'])->name('professeurs.update');
Route::delete('/professeurs/{id}', [ProfesseurController::class, 'destroy'])->name('professeurs.destroy');


Route::get('/matieres', [MatiereController::class, 'index'])->name('matieres.index');
Route::get('/matieres/create', [MatiereController::class, 'create'])->name('matieres.create');
Route::post('/matieres', [MatiereController::class, 'store'])->name('matieres.store'); // Corrected
Route::get('/matieres/{id}/edit', [MatiereController::class, 'edit'])->name('matieres.edit');
Route::put('/matieres/{id}', [MatiereController::class, 'update'])->name('matieres.update');
Route::delete('/matieres/{id}', [MatiereController::class, 'destroy'])->name('matieres.destroy');

