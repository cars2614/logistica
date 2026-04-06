<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoEntrega;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TipoEntregaController extends Controller
{
    /**
     * Muestra el listado de tipos de entrega y el formulario de creación.
     */
    public function index(): View
    {
        $tipoEntregas = TipoEntrega::orderBy('id', 'desc')->paginate(10);

        return view('admin.tipo_entrega.index', compact('tipoEntregas'));
    }

    /**
     * Almacena un nuevo tipo de entrega en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre'      => 'required|string|max:255|unique:tipo_entregas,nombre',
            'descripcion' => 'required|string|max:255',
            'estado'      => 'required|in:0,1',
        ], [
            'nombre.required'      => 'El nombre es obligatorio.',
            'nombre.unique'        => 'Ya existe un tipo de entrega con ese nombre.',
            'nombre.max'           => 'El nombre no puede superar los 255 caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max'      => 'La descripción no puede superar los 255 caracteres.',
            'estado.required'      => 'El estado es obligatorio.',
            'estado.in'            => 'El estado seleccionado no es válido.',
        ]);

        TipoEntrega::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado'      => $request->estado,
        ]);

        return redirect()
            ->route('admin.tipo-entrega.index')
            ->with('success', 'Tipo de entrega creado correctamente.');
    }

    /**
     * Muestra el formulario de edición de un tipo de entrega.
     */
    public function edit(TipoEntrega $tipoEntrega): View
    {
        return view('admin.tipo_entrega.edit', compact('tipoEntrega'));
    }

    /**
     * Actualiza un tipo de entrega en la base de datos.
     */
    public function update(Request $request, TipoEntrega $tipoEntrega): RedirectResponse
    {
        $request->validate([
            'nombre'      => 'required|string|max:255|unique:tipo_entregas,nombre,' . $tipoEntrega->id,
            'descripcion' => 'required|string|max:255',
            'estado'      => 'required|in:0,1',
        ], [
            'nombre.required'      => 'El nombre es obligatorio.',
            'nombre.unique'        => 'Ya existe un tipo de entrega con ese nombre.',
            'nombre.max'           => 'El nombre no puede superar los 255 caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max'      => 'La descripción no puede superar los 255 caracteres.',
            'estado.required'      => 'El estado es obligatorio.',
            'estado.in'            => 'El estado seleccionado no es válido.',
        ]);

        $tipoEntrega->update([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado'      => $request->estado,
        ]);

        return redirect()
            ->route('admin.tipo-entrega.index')
            ->with('success', 'Tipo de entrega actualizado correctamente.');
    }

    /**
     * Elimina un tipo de entrega de la base de datos.
     */
    public function destroy(TipoEntrega $tipoEntrega): RedirectResponse
    {
        $tipoEntrega->delete();

        return redirect()
            ->route('admin.tipo-entrega.index')
            ->with('success', 'Tipo de entrega eliminado correctamente.');
    }
}
