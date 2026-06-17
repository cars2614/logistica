<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRutaRequest;
use App\Http\Requests\UpdateRutaRequest;
use App\Models\Ruta;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class RutaController extends Controller
{
    /**
     * Vista Principal (Tema Premium Dark + Contenedor de Mapas)
     */
    public function index()
    {
        // Cargamos los datos con contadores optimizados para las tarjetas laterales
        $rutas = Ruta::withCount(['planillas'])->orderBy('zona')->get();

        return view('admin.ruta.index', compact('rutas'));
    }

    /**
     * API Rest para Leaflet.js (Evita lag operativo y optimiza memoria)
     */
    public function getGeoData(): JsonResponse
    {
        $geoData = Ruta::select('id', 'zona as nombre', 'latitud', 'longitud', 'color_hex')
            ->whereNotNull('latitud')
            ->whereNotNull('longitud')
            ->get();

        return response()->json($geoData);
    }

    public function store(StoreRutaRequest $request)
    {
        // Capturamos los datos validados
        $datos = $request->validated();

        // Parche: Llenamos 'descripcion' con un string vacío para satisfacer a la BD vieja
        $datos['descripcion'] = '';

        // Generar un color aleatorio premium si no viene
        $datos['color_hex'] = $this->getRandomPremiumColor();

        Ruta::create($datos);

        return redirect()->route('admin.ruta.index')
            ->with('success', 'Ruta creada y geolocalizada correctamente.');
    }

    public function edit($id)
    {
        $ruta = Ruta::findOrFail($id);

        return view('admin.ruta.edit', compact('ruta'));
    }

    public function update(UpdateRutaRequest $request, $id)
    {
        $ruta = Ruta::findOrFail($id);

        // Capturamos los datos validados
        $datos = $request->validated();

        // Parche: Mantenemos el campo feliz en la actualización también
        $datos['descripcion'] = '';

        $ruta->update($datos);

        return redirect()->route('admin.ruta.index')
            ->with('success', 'Ruta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $ruta = Ruta::findOrFail($id);

        try {
            $ruta->delete();

            return redirect()->route('admin.ruta.index')
                ->with('success', 'Ruta eliminada correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('admin.ruta.index')
                ->with('error', 'No se puede eliminar esta ruta porque tiene planillas asociadas.');
        }
    }

    private function getRandomPremiumColor()
    {
        $colors = ['#0EA5E9', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899', '#14B8A6'];

        return $colors[array_rand($colors)];
    }
}
