<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TipoEntregaController;
use App\Http\Controllers\Admin\CiudadController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\TipovehiculoController;

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

    // CRUD Ciudad
    Route::resource('ciudad', CiudadController::class)
        ->parameters(['ciudad' => 'ciudad'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    // CRUD Cliente
    Route::resource('cliente', ClienteController::class)
        ->parameters(['cliente' => 'cliente'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    // CRUD Rol
    Route::resource('rol', RolController::class)
        ->parameters(['rol' => 'rol'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    // CRUD Tipo de Vehículo
    Route::resource('tipo-vehiculo', TipovehiculoController::class)
        ->parameters(['tipo-vehiculo' => 'tipoVehiculo'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);
});


