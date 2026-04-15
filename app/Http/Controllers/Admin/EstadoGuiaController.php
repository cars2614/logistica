<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EstadoGuia;
use App\Models\Guia;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class EstadoGuiaController extends Controller
{
    public function index()
    {
        $estadoGuias = EstadoGuia::with('guia')->orderBy('id', 'desc')->paginate(10);
        $guias       = Guia::orderBy('num_guias')->get();

        return view('admin.estado_guia.index', compact('estadoGuias', 'guias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_estado' => 'required|date',
            'estado'       => 'required|string|max:255',
            'descripcion'  => 'required|string|max:255',
            'guia_id'      => 'required|exists:guias,id_guias',
        ]);

        EstadoGuia::create($request->only([
            'fecha_estado',
            'estado',
            'descripcion',
            'guia_id',
        ]));

        return redirect()->route('admin.estado-guia.index')
            ->with('success', 'Estado de guía creado correctamente.');
    }

    public function edit($id)
    {
        $estadoGuia = EstadoGuia::findOrFail($id);
        $guias      = Guia::orderBy('num_guias')->get();

        return view('admin.estado_guia.edit', compact('estadoGuia', 'guias'));
    }

    public function update(Request $request, $id)
    {
        $estadoGuia = EstadoGuia::findOrFail($id);

        $request->validate([
            'fecha_estado' => 'required|date',
            'estado'       => 'required|string|max:255',
            'descripcion'  => 'required|string|max:255',
            'guia_id'      => 'required|exists:guias,id_guias',
        ]);

        $estadoGuia->update($request->only([
            'fecha_estado',
            'estado',
            'descripcion',
            'guia_id',
        ]));

        return redirect()->route('admin.estado-guia.index')
            ->with('success', 'Estado de guía actualizado correctamente.');
    }

    public function destroy($id)
    {
        $estadoGuia = EstadoGuia::findOrFail($id);

        try {
            $estadoGuia->delete();
            return redirect()->route('admin.estado-guia.index')
                ->with('success', 'Estado de guía eliminado correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('admin.estado-guia.index')
                ->with('error', 'No se puede eliminar este registro porque tiene datos asociados.');
        }
    }
}