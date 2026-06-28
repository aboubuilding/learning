<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Recherche de formations
Route::get('/recherche', [HomeController::class, 'search'])->name('home.search');

// Authentification (statique)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes protégées par session
Route::middleware('auth.session')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');

    Route::get('/formateur/dashboard', function () {
        return view('dashboard.formateur');
    })->name('formateur.dashboard');

    Route::get('/apprenant/dashboard', function () {
        return view('dashboard.apprenant');
    })->name('apprenant.dashboard');
});