<?php

namespace App\Http\Controllers;

use App\Models\Guia;
use App\Models\UbicacionGuia;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    // Dashboard principal para el tracking
    public function index()
    {
        // Obtener las guías del cliente autenticado (si aplica)
        // Por ahora redirigimos al home o mostramos un buscador genérico
        return view('dashboard'); // O la vista que prefieras para el cliente
    }

    // Vista del mapa para el cliente
    public function show($guiaId)
    {
        $guia = Guia::with(['ultimaUbicacion', 'estados'])->findOrFail($guiaId);
        return view('tracking.show', compact('guia'));
    }

    // API: retorna todas las ubicaciones de la guía
    public function ubicaciones($guiaId)
    {
        $ubicaciones = UbicacionGuia::where('guia_id', $guiaId)
            ->orderBy('created_at')
            ->get(['latitud', 'longitud', 'descripcion', 'created_at']);

        return response()->json($ubicaciones);
    }

    // El conductor/admin registra su posición actual
    public function actualizar(Request $request, $guiaId)
    {
        $request->validate([
            'latitud'     => 'required|numeric',
            'longitud'    => 'required|numeric',
            'descripcion' => 'nullable|string|max:255',
        ]);

        UbicacionGuia::create([
            'guia_id'     => $guiaId,
            'latitud'     => $request->latitud,
            'longitud'    => $request->longitud,
            'descripcion' => $request->descripcion ?? 'En camino',
        ]);

        return response()->json(['ok' => true, 'mensaje' => 'Ubicación guardada']);
    }
}
