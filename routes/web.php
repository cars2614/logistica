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
use App\Http\Controllers\Admin\TrackingController;

require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');

// Panel administrativo
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('tipo-entrega', TipoEntregaController::class)
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('ciudad', CiudadController::class)
        ->parameters(['ciudad' => 'ciudad'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('cliente', ClienteController::class)
        ->parameters(['cliente' => 'cliente'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('rol', RolController::class)
        ->parameters(['rol' => 'rol'])
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

    Route::resource('estado-guia', EstadoGuiaController::class)
        ->parameters(['estado-guia' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('planilla', PlanillaController::class)
        ->parameters(['planilla' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('ruta', RutaController::class)
        ->parameters(['ruta' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);
});



// Grupo de rutas protegidas por autenticación (si ya usa el middleware auth)
Route::middleware(['auth'])->group(function () {
    
    // 🗺️ 1. Ruta para mostrar la vista principal del mapa y control de estados
    Route::get('/tracking/{id}', [TrackingController::class, 'show'])->name('tracking.show');

    // ⚡ 2. Ruta POST para recibir las actualizaciones del GPS o del botón manual
    Route::post('/tracking/{id}/actualizar', [TrackingController::class, 'actualizar'])->name('tracking.actualizar');

    // 🔄 3. Ruta GET que consulta los puntos históricos para pintar la línea en el mapa
    Route::get('/tracking/{id}/ubicaciones', [TrackingController::class, 'ubicaciones'])->name('tracking.ubicaciones');

});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepartidorController; // Importación limpia añadida
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
use App\Http\Controllers\Admin\TrackingController;
use App\Http\Controllers\Admin\RepartidorManagementController;

// 1. Página pública de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Rutas de autenticación (generadas por Breeze)
require __DIR__ . '/auth.php';

// 3. Rutas de Repartidor — Protegidas por autenticación y optimizadas
Route::middleware(['auth'])->prefix('repartidor')->name('repartidor.')->group(function () {
    // Cambiado el método a 'index' para que coincida con tu Plan de Implementación
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

    Route::resource('rol', RolController::class)
        ->parameters(['rol' => 'rol'])
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

    Route::resource('estado-guia', EstadoGuiaController::class)
        ->parameters(['estado-guia' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('planilla', PlanillaController::class)
        ->parameters(['planilla' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::resource('ruta', RutaController::class)
        ->parameters(['ruta' => 'id'])
        ->only(['index', 'store', 'edit', 'update', 'destroy']);

    Route::get('/repartidores/create', [RepartidorManagementController::class, 'create'])->name('repartidor.create');
    Route::post('/repartidores', [RepartidorManagementController::class, 'store'])->name('repartidor.store');
    
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

// Ruta temporal para hacer administrador al usuario mono
Route::get('/make-admin', function() {
    $user = \App\Models\User::where('name', 'like', '%mono%')->orWhere('email', 'like', '%mono%')->first();
    if ($user) {
        $rol = \App\Models\Rol::where('nombreRol', 'Administrador')->first();
        if ($rol) {
            $user->id_rol = $rol->id;
            $user->save();
            return "¡Éxito! El usuario {$user->name} ahora es Administrador. Ya puedes probar el sistema.";
        }
        return "Error: Rol Administrador no encontrado.";
    }
    return "Error: Usuario mono no encontrado.";
});