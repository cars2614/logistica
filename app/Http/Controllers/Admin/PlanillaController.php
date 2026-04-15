<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Planilla;
use App\Models\Guia;
use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PlanillaController extends Controller
{
    public function index()
    {
        $planillas = Planilla::with(['guia', 'ruta'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        $guias = Guia::orderBy('num_guias')->get();
        $rutas = Ruta::orderBy('id')->get();

        return view('admin.planillas.index', compact('planillas', 'guias', 'rutas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destinatario' => 'required|string|max:255',
            'direccion'    => 'required|string|max:255',
            'comentario'   => 'required|string|max:255',
            'destino'      => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'entidad'      => 'required|string|max:255',
            'servicio'     => 'required|string|max:255',
            'piezas'       => 'required|integer|min:0',
            'kilos'        => 'required|numeric|min:0',
            'opedor'       => 'required|string|max:255',
            'guia_id'      => 'required|exists:guias,id_guias',
            'ruta_id'      => 'required|exists:rutas,id',
        ]);

        Planilla::create($request->only([
            'destinatario', 'direccion', 'comentario', 'destino',
            'departamento', 'entidad', 'servicio', 'piezas',
            'kilos', 'opedor', 'guia_id', 'ruta_id',
        ]));

        return redirect()->route('admin.planilla.index')
            ->with('success', 'Planilla creada correctamente.');
    }

    public function edit($id)
    {
        $planilla = Planilla::findOrFail($id);
        $guias    = Guia::orderBy('num_guias')->get();
        $rutas    = Ruta::orderBy('id')->get();

        return view('admin.planilla.edit', compact('planilla', 'guias', 'rutas'));
    }

    public function update(Request $request, $id)
    {
        $planilla = Planilla::findOrFail($id);

        $request->validate([
            'destinatario' => 'required|string|max:255',
            'direccion'    => 'required|string|max:255',
            'comentario'   => 'required|string|max:255',
            'destino'      => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'entidad'      => 'required|string|max:255',
            'servicio'     => 'required|string|max:255',
            'piezas'       => 'required|integer|min:0',
            'kilos'        => 'required|numeric|min:0',
            'opedor'       => 'required|string|max:255',
            'guia_id'      => 'required|exists:guias,id_guias',
            'ruta_id'      => 'required|exists:rutas,id',
        ]);

        $planilla->update($request->only([
            'destinatario', 'direccion', 'comentario', 'destino',
            'departamento', 'entidad', 'servicio', 'piezas',
            'kilos', 'opedor', 'guia_id', 'ruta_id',
        ]));

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