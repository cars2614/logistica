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
        $guias       = Guia::orderBy('id')->get();

        return view('admin.estado_guia.index', compact('estadoGuias', 'guias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_estado' => 'required|date',
            'estado'       => 'required|string|max:255',
            'descripcion'  => 'required|string|min:10|max:255',
            'id_guia'      => 'required|exists:guias,id_guias',
        ], [
            'fecha_estado.required' => 'La fecha del estado es obligatoria.',
            'estado.required'       => 'El estado es obligatorio.',
            'descripcion.required'  => 'La descripción es obligatoria.',
            'descripcion.min'       => 'La descripción debe tener al menos 10 caracteres.',
            'id_guia.required'      => 'La guía es obligatoria.',
            'id_guia.exists'        => 'La guía seleccionada no existe.',
        ]);

        EstadoGuia::create([
            'fecha_estado' => $request->fecha_estado,
            'estado'       => $request->estado,
            'descripcion'  => $request->descripcion,
            'id_guia'      => $request->id_guia,
            'id_usuario'   => auth()->id(),
        ]);

        return redirect()->route('admin.estado-guia.index')
            ->with('success', 'Estado de guía creado correctamente.');
    }

    public function edit($id)
    {
        $estadoGuia = EstadoGuia::findOrFail($id);
        $guias      = Guia::orderBy('id')->get();

        return view('admin.estado_guia.edit', compact('estadoGuia', 'guias'));
    }

    public function update(Request $request, $id)
    {
        $estadoGuia = EstadoGuia::findOrFail($id);

        $request->validate([
            'fecha_estado' => 'required|date',
            'estado'       => 'required|string|max:255',
            'descripcion'  => 'required|string|min:10|max:255',
            'id_guia'      => 'required|exists:guias,id_guias',
        ], [
            'fecha_estado.required' => 'La fecha del estado es obligatoria.',
            'estado.required'       => 'El estado es obligatorio.',
            'descripcion.required'  => 'La descripción es obligatoria.',
            'descripcion.min'       => 'La descripción debe tener al menos 10 caracteres.',
            'id_guia.required'      => 'La guía es obligatoria.',
            'id_guia.exists'        => 'La guía seleccionada no existe.',
        ]);

        $estadoGuia->update([
            'fecha_estado' => $request->fecha_estado,
            'estado'       => $request->estado,
            'descripcion'  => $request->descripcion,
            'id_guia'      => $request->id_guia,
        ]);

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