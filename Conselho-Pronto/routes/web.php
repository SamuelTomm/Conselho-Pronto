<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Rotas de autenticação
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rotas de recuperação de senha
Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password.post');

// Rotas protegidas (exemplo)
Route::middleware(['auth.session'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.admin');
    })->name('dashboard');
    
    Route::get('/dashboard/professor-turmas', function () {
        return view('dashboard.professor');
    })->name('dashboard.professor');
    
    Route::get('/dashboard/conselho-classe', function () {
        return view('dashboard.coordenador');
    })->name('dashboard.coordenador');
});
