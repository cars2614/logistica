<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TipoEntregaController;
use App\Http\Controllers\Admin\CiudadController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\TipovehiculoController;
use App\Http\Controllers\Admin\VehiculoController;
use App\Http\Controllers\Admin\GuiaController;
use App\Http\Controllers\Admin\EstadoGuiaController;
use App\Http\Controllers\Admin\PlanillaController;
use App\Http\Controllers\Admin\RutaController;

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

    // CRUD Vehículo
    Route::resource('vehiculo', VehiculoController::class)
        ->parameters(['vehiculo' => 'vehiculo'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    // CRUD Guía
    Route::resource('guia', GuiaController::class)
        ->parameters(['guia' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    // CRUD Estado de Guía
    Route::resource('estado-guia', EstadoGuiaController::class)
        ->parameters(['estado-guia' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    // CRUD Planilla
    Route::resource('planilla', PlanillaController::class)
        ->parameters(['planilla' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    // CRUD Ruta
    Route::resource('ruta', RutaController::class)
        ->parameters(['ruta' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);
});
