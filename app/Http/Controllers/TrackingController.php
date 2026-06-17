<?php

// app/Http/Controllers/TrackingController.php
use App\Models\Guia;
use App\Models\UbicacionGuia;

class TrackingController extends Controller
{
    // Vista del mapa para el cliente
    public function show($guiaId)
    {
        $guia = Guia::with(['ultimaUbicacion', 'estado_guias'])->findOrFail($guiaId);
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
