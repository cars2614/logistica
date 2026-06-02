<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Planilla;
use App\Models\Guia;
use App\Models\Ruta;
use App\Models\ciudad;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PlanillaController extends Controller
{
    public function index()
    {
        $planillas = Planilla::with(['ciudad', 'ruta'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        $ciudades = ciudad::orderBy('nombre')->get();
        $rutas    = Ruta::orderBy('id')->get();

        return view('admin.planillas.index', compact('planillas', 'ciudades', 'rutas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ciudad' => 'required|exists:ciudades,id',
            'id_ruta'   => 'required|exists:rutas,id',
            'piezas'    => 'required|integer|min:1',
            'kilos'     => 'required|numeric|min:0',
        ], [
            'id_ciudad.required' => 'La ciudad es obligatoria.',
            'id_ciudad.exists'   => 'La ciudad seleccionada no existe.',
            'id_ruta.required'   => 'La ruta es obligatoria.',
            'id_ruta.exists'     => 'La ruta seleccionada no existe.',
            'piezas.required'    => 'Las piezas son obligatorias.',
            'piezas.min'         => 'Las piezas deben ser al menos 1.',
            'kilos.required'     => 'Los kilos son obligatorios.',
            'kilos.min'          => 'Los kilos no pueden ser negativos.',
        ]);

        Planilla::create([
            'id_ciudad'  => $request->id_ciudad,
            'id_usuario' => auth()->id(),
            'id_ruta'    => $request->id_ruta,
            'piezas'     => $request->piezas,
            'kilos'      => $request->kilos,
        ]);

        return redirect()->route('admin.planilla.index')
            ->with('success', 'Planilla creada correctamente.');
    }

    public function edit($id)
    {
        $planilla = Planilla::findOrFail($id);
        $ciudades = ciudad::orderBy('nombre')->get();
        $rutas    = Ruta::orderBy('id')->get();

        return view('admin.planillas.edit', compact('planilla', 'ciudades', 'rutas'));
    }

    public function update(Request $request, $id)
    {
        $planilla = Planilla::findOrFail($id);

        $request->validate([
            'id_ciudad' => 'required|exists:ciudades,id',
            'id_ruta'   => 'required|exists:rutas,id',
            'piezas'    => 'required|integer|min:1',
            'kilos'     => 'required|numeric|min:0',
        ], [
            'id_ciudad.required' => 'La ciudad es obligatoria.',
            'id_ciudad.exists'   => 'La ciudad seleccionada no existe.',
            'id_ruta.required'   => 'La ruta es obligatoria.',
            'id_ruta.exists'     => 'La ruta seleccionada no existe.',
            'piezas.required'    => 'Las piezas son obligatorias.',
            'piezas.min'         => 'Las piezas deben ser al menos 1.',
            'kilos.required'     => 'Los kilos son obligatorios.',
            'kilos.min'          => 'Los kilos no pueden ser negativos.',
        ]);

        $planilla->update([
            'id_ciudad' => $request->id_ciudad,
            'id_ruta'   => $request->id_ruta,
            'piezas'    => $request->piezas,
            'kilos'     => $request->kilos,
        ]);

        return redirect()->route('admin.planilla.index')
            ->with('success', 'Planilla actualizada correctamente.');
    }

    public function destroy($id)
    {
        $planilla = Planilla::findOrFail($id);

        try {
            $planilla->delete();
            return redirect()->route('admin.planilla.index')
                ->with('success', 'Planilla eliminada correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('admin.planilla.index')
                ->with('error', 'No se puede eliminar esta planilla porque tiene registros asociados.');
        }
    }
}