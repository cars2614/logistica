<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TipoEntregaController;
use App\Http\Controllers\Admin\CiudadController;
use App\Http\Controllers\Admin\ClienteController;

use App\Http\Controllers\Admin\TipovehiculoController;
use App\Http\Controllers\Admin\VehiculoController;
use App\Http\Controllers\Admin\GuiaController;
use App\Http\Controllers\Admin\PlanillaController;
use App\Http\Controllers\Admin\RutaController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\Admin\RepartidorManagementController;

use App\Http\Controllers\ProfileController;

// 1. Página pública de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// 1.5 Rutas de Perfil (Profile)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 2. Rutas de autenticación (generadas por Breeze)
require __DIR__ . '/auth.php';

// 3. Rutas de Repartidor — Protegidas por autenticación y optimizadas
Route::middleware(['auth'])->prefix('repartidor')->name('repartidor.')->group(function () {
    Route::get('/dashboard', [RepartidorController::class, 'index'])->name('dashboard'); 
    Route::post('/guia/{guia}/estado', [RepartidorController::class, 'actualizarEstado'])->name('estado');
});

// 4. Panel administrativo — protegido por autenticación y rol de administrador
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('tipo-entrega', TipoEntregaController::class)
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('ciudad', CiudadController::class)
        ->parameters(['ciudad' => 'ciudad'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('cliente', ClienteController::class)
        ->parameters(['cliente' => 'cliente'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);



    Route::resource('tipo-vehiculo', TipovehiculoController::class)
        ->parameters(['tipo-vehiculo' => 'tipoVehiculo'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('vehiculo', VehiculoController::class)
        ->parameters(['vehiculo' => 'vehiculo'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('guia', GuiaController::class)
        ->parameters(['guia' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    // Nueva ruta para actualizar estado desde la Guía
    Route::post('/guia/{guia}/estado', [GuiaController::class, 'actualizarEstado'])->name('guia.estado');

    // Planillas (Manifiestos)
    Route::get('planilla/plantilla', [PlanillaController::class, 'descargarPlantilla'])->name('planilla.plantilla');
    Route::post('planilla/importar', [PlanillaController::class, 'importarExcel'])->name('planilla.importar');
    Route::resource('planilla', PlanillaController::class)
        ->parameters(['planilla' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::get('ruta/geodata', [RutaController::class, 'getGeoData'])->name('ruta.geodata');
    Route::resource('ruta', RutaController::class)
        ->parameters(['ruta' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::get('/repartidores/create', [RepartidorManagementController::class, 'create'])->name('repartidor.create');
    Route::post('/repartidores', [RepartidorManagementController::class, 'store'])->name('repartidor.store');
    Route::put('/repartidores/{id}', [RepartidorManagementController::class, 'update'])->name('repartidor.update');
    Route::put('/repartidores/{id}/vehicle', [RepartidorManagementController::class, 'assignVehicle'])->name('repartidor.vehicle');
    
    // Ruta protegida para que solo administradores reseteen contraseñas
    Route::put('/repartidores/{id}/password', [RepartidorManagementController::class, 'updatePassword'])->name('repartidor.password');
});

// 5. Módulo de Tracking (Público + Rutas Adicionales para el Cliente)
Route::get('/tracking/{guia}', [TrackingController::class, 'show'])->name('tracking.show');
Route::get('/tracking/{guia}/ubicaciones', [TrackingController::class, 'ubicaciones'])->name('tracking.ubicaciones');

// Añadimos un alias o name formal para que la barra de navegación dinámica no falle con el cliente
Route::post('/tracking/{guia}/actualizar', [TrackingController::class, 'actualizar'])
    ->middleware('auth')
    ->name('tracking.actualizar');

// Ruta base para que el rol Cliente herede el Dashboard de rastreo limpiamente
Route::get('/tracking', [TrackingController::class, 'index'])->middleware('auth')->name('tracking.index');