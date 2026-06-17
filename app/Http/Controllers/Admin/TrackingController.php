<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EstadoGuia;
use App\Models\Guia;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    // Lista oficial de estados y detalles de Carga y Logística Tolima
    private array $estadosDelSistema = [
        'En Bodega' => ['Recibido en Oficina', 'Clasificado', 'Listo para Despacho'],
        'En Ruta' => ['En Tránsito', 'Cerca al domicilio', 'En Distribución'],
        'Entregado' => ['Entregado Satisfactoriamente', 'Entregado con Novedad'],
        'Devolución' => ['Dirección Incorrecta', 'Cliente Ausente', 'Rechazado por el Cliente', 'Zona de Difícil Acceso'],
    ];

    public function show($id)
    {
        $guia = Guia::with(['clienteOrigen', 'clienteDestino', 'tipoEntrega', 'estados'])->findOrFail($id);
        $usuario = auth()->user();

        $esAdmin = $usuario && $usuario->hasRole(\App\Enums\RoleEnum::ADMIN->value);
        $esRepartidor = $usuario && $usuario->hasRole(\App\Enums\RoleEnum::REPARTIDOR->value);
        $esCliente = ! $esAdmin && ! $esRepartidor;

        $ultimoEstado = $guia->estados()->latest()->first();

        return view('admin.tracking.show', compact(
            'guia', 'ultimoEstado', 'esAdmin', 'esRepartidor', 'esCliente', 'usuario'
        ))->with('estadosDelSistema', $this->estadosDelSistema);
    }

    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);

        $guia = Guia::findOrFail($id);
        $user = auth()->user();

        // 1. Verificación de Seguridad Anti-IDOR
        $esAdmin = $user && $user->hasRole(\App\Enums\RoleEnum::ADMIN->value);
        
        if (!$esAdmin && $guia->id_repartidor !== $user->id) {
            return response()->json([
                'status' => 'error',
                'mensaje' => 'Acceso denegado. No tienes permiso para actualizar esta guía.'
            ], 403);
        }

        $usuarioId = $user->id;

        // Registro físico en la tabla estado_guias
        $nuevoEstado = EstadoGuia::create([
            'id_guia' => $guia->id,
            'id_usuario' => $usuarioId,
            'estado' => $request->estado,
            'descripcion' => $request->descripcion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'fecha_estado' => now('-05:00')->format('Y-m-d H:i:s'),
        ]);

        return response()->json([
            'status' => 'success',
            'mensaje' => 'Ubicación guardada correctamente en MySQL.',
            'datos' => $nuevoEstado,
        ]);
    }

    public function ubicaciones($id)
    {
        $guia = Guia::findOrFail($id);

        // Traemos los puntos ordenados por ID para que la línea del mapa mantenga el orden del recorrido
        $puntos = $guia->estados()->orderBy('id', 'asc')->get();

        return response()->json(['puntos' => $puntos]);
    }
}
