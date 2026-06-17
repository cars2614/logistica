<?php

namespace App\Services;

use App\Models\Guia;
use App\Models\HistorialEstadoGuia;
use App\Models\Planilla;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogisticaService
{
    /**
     * Cambia el estado de una guía de manera atómica (Transaccional)
     */
    public function cambiarEstadoGuia(int $guiaId, string $nuevoEstado, ?string $observaciones = null): Guia
    {
        return DB::transaction(function () use ($guiaId, $nuevoEstado, $observaciones) {
            $guia = Guia::findOrFail($guiaId);
            
            // 1. Actualizar el estado en el maestro
            $guia->estado_actual = $nuevoEstado;
            $guia->save();

            // 2. Registrar en la tabla subordinada de historial (Auditoría sagrada)
            HistorialEstadoGuia::create([
                'guia_id' => $guia->id,
                'estado' => $nuevoEstado,
                'observaciones' => $observaciones,
                'user_id' => Auth::id() ?? 1, // Automático desde el servidor (fallback a 1 para pruebas si no hay sesión)
            ]);

            // 3. Aquí se dispararían futuros eventos (Ej: Enviar SMS/WhatsApp al cliente)
            // event(new EstadoGuiaCambiado($guia));

            return $guia;
        });
    }

    /**
     * Crea una planilla de despacho blindada
     */
    public function crearPlanillaDespacho(array $datos): Planilla
    {
        return DB::transaction(function () use ($datos) {
            $planilla = new Planilla([
                'numero_planilla' => 'PL-' . strtoupper(uniqid()),
                'id_ruta'         => $datos['ruta_id'],
                'vehiculo_id'     => $datos['vehiculo_id'],
                'piezas'          => $datos['piezas'],
                'kilos'           => $datos['kilos'],
                'id_ciudad'       => \App\Models\Ciudad::first()?->id ?? 1,
                'id_usuario'      => Auth::id() ?? 1,
            ]);
            $planilla->save();
            return $planilla;
        });
    }
}
