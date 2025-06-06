<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantsController;

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
    

    // Routes pour les étudiants
    Route::get('/etudiants', [EtudiantsController::class, 'index'])->name('etudiants.index')->middleware('auth');
    Route::get('/etudiants/create', [EtudiantsController::class, 'create'])->name('etudiants.create');
    Route::post('/etudiants/store', [EtudiantsController::class, 'store'])->name('etudiants.store');
    Route::get('/etudiants/{etudiant}/edit', [EtudiantsController::class, 'edit'])->name('etudiants.edit');
    Route::put('/etudiants/{etudiant}', [EtudiantsController::class, 'update'])->name('etudiants.update');
    Route::delete('/etudiants/{etudiant}', [EtudiantsController::class, 'destroy'])->name('etudiants.destroy');
    Route::get('/etudiants/{etudiant}/download', [EtudiantsController::class, 'download'])->name('etudiants.download');
});

require __DIR__ . '/auth.php';
