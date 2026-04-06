<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TipoEntregaController;

// Rutas de autenticación (generadas por Breeze)
require __DIR__ . '/auth.php';

// Página pública de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Panel administrativo — protegido por autenticación
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Tipo de Entrega
    Route::resource('tipo-entrega', TipoEntregaController::class)
        ->only(['index', 'store', 'edit', 'update', 'destroy']);
});
