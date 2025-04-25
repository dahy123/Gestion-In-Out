<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtudiantsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Routes pour les étudiants
Route::get('/etudiants', [EtudiantsController::class, 'index'])->name('etudiants.index')->middleware('auth');
Route::get('/etudiants/create', [EtudiantsController::class, 'create'])->name('etudiants.create');
Route::post('/etudiants/store', [EtudiantsController::class, 'store'])->name('etudiants.store');
Route::get('/etudiants/{etudiant}/edit', [EtudiantsController::class, 'edit'])->name('etudiants.edit');
Route::put('/etudiants/{etudiant}', [EtudiantsController::class, 'update'])->name('etudiants.update');
Route::delete('/etudiants/{etudiant}', [EtudiantsController::class, 'destroy'])->name('etudiants.destroy');
Route::get('/etudiants/{etudiant}/download', [EtudiantsController::class, 'download'])->name('etudiants.download');

Route::get('login',[AuthController::class,'login'])->name('auth.login');
Route::post('toLogin',[AuthController::class,'toLogin'])->name('auth.toLogin');
Route::delete('logout',[AuthController::class,'logout'])->name('auth.logout');