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

// Rotas protegidas do dashboard
Route::middleware(['auth.session'])->prefix('dashboard')->group(function () {
    // Dashboard principal
    Route::get('/', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');
    
    // Módulos principais (serão implementados)
    Route::resource('alunos', App\Http\Controllers\Dashboard\AlunoController::class);
    Route::resource('professores', App\Http\Controllers\Dashboard\ProfessorController::class);
    Route::resource('turmas', App\Http\Controllers\Dashboard\TurmaController::class);
    Route::resource('disciplinas', App\Http\Controllers\Dashboard\DisciplinaController::class);
    Route::resource('cursos', App\Http\Controllers\Dashboard\CursoController::class);
    
    // Ciclos (Anos Letivos) routes
    Route::get('ciclos', [App\Http\Controllers\Dashboard\CicloController::class, 'index'])->name('ciclos.index');
    Route::post('ciclos', [App\Http\Controllers\Dashboard\CicloController::class, 'store'])->name('ciclos.store');
    Route::put('ciclos/{id}', [App\Http\Controllers\Dashboard\CicloController::class, 'update'])->name('ciclos.update');
    Route::delete('ciclos/{id}', [App\Http\Controllers\Dashboard\CicloController::class, 'destroy'])->name('ciclos.destroy');
    
    // Módulos especiais
    Route::get('conselho-classe', [App\Http\Controllers\Dashboard\ConselhoClasseController::class, 'index'])->name('conselho-classe');
    Route::get('professor-turmas', [App\Http\Controllers\Dashboard\ProfessorTurmaController::class, 'index'])->name('professor-turmas');
    Route::get('configuracoes', [App\Http\Controllers\Dashboard\ConfiguracaoController::class, 'index'])->name('configuracoes');
});
