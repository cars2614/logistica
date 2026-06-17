<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTipoEntregaRequest;
use App\Http\Requests\UpdateTipoEntregaRequest;
use App\Models\TipoEntrega;
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
    public function store(StoreTipoEntregaRequest $request): RedirectResponse
    {
        TipoEntrega::create($request->validated());

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
    public function update(UpdateTipoEntregaRequest $request, TipoEntrega $tipoEntrega): RedirectResponse
    {
        $tipoEntrega->update($request->validated());

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
