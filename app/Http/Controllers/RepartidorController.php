<?php

namespace App\Http\Controllers;

use App\Models\EstadoGuia;
use App\Models\Guia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepartidorController extends Controller
{
    /**
     * Display a listing of the resource for the delivery driver.
     */
    public function index()
    {
        $user = Auth::user();

        // Obtener las guías asignadas directamente al repartidor
        // Cargamos las relaciones y filtramos aquellas cuyo último estado sea "Entregado" o "Novedad/Devolución"
        $guias = Guia::where('id_repartidor', $user->id)
            ->with(['clienteDestino', 'estados' => function ($query) {
                $query->orderBy('id', 'desc');
            }])
            ->get()
            ->filter(function ($guia) {
                $estadoActual = $guia->estadoActual ? $guia->estadoActual->estado : 'Bodega/Asignado';

                return ! in_array($estadoActual, ['Entregado', 'Novedad/Devolución']);
            });

        // Ordenamos las guías por dirección del destino o por ID
        // Como clienteDestino es una relación, podemos ordenarlo después de obtener la colección o hacer un join.
        // Haremos sortBy en la colección para mayor simplicidad.
        $guias = $guias->sortBy(function ($guia) {
            return $guia->clienteDestino->direccion ?? '';
        });

        return view('repartidor.dashboard', compact('guias'));
    }

    /**
     * Update the state of a specific guide.
     */
    public function actualizarEstado(Request $request, Guia $guia)
    {
        // 1. Verificación de Seguridad Anti-IDOR
        if ($guia->id_repartidor !== Auth::id()) {
            abort(403, 'Acceso denegado. No tienes permiso para actualizar una guía que no te ha sido asignada.');
        }

        $request->validate([
            'estado' => 'required|string|in:Bodega/Asignado,En ruta,Entregado,Novedad/Devolución',
        ]);

        $nuevoEstado = $request->input('estado');
        $estadoActual = $guia->estadoActual ? $guia->estadoActual->estado : null;

        // Solo registramos el nuevo estado si es diferente al actual
        if ($estadoActual !== $nuevoEstado) {
            EstadoGuia::create([
                'id_guia' => $guia->id,
                'id_usuario' => Auth::id(),
                'estado' => $nuevoEstado,
                'fecha_estado' => now(),
                'descripcion' => 'Actualizado por el repartidor desde el dashboard móvil.',
            ]);
        }

        return redirect()->route('repartidor.dashboard')->with('success', 'Estado actualizado correctamente a '.$nuevoEstado);
    }
}
