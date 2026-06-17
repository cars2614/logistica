<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCiudadRequest;
use App\Http\Requests\UpdateCiudadRequest;
use App\Models\Ciudad;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CiudadController extends Controller
{
    /**
     * Muestra la lista de ciudades.
     */
    public function index(): View
    {
        // Usamos latest() que es un shortcut de orderBy('created_at', 'desc') o por ID
        $ciudades = Ciudad::latest('id')->get();

        // Ajustamos la ruta de la vista a 'admin.ciudad.index'
        // asumiendo que sigues la estructura de carpetas de tu controlador.
        return view('admin.Ciudad.index', compact('ciudades'));
    }

    /**
     * Almacena una nueva ciudad.
     */
    public function store(StoreCiudadRequest $request): RedirectResponse
    {
        Ciudad::create($request->validated());

        return redirect()->route('admin.ciudad.index')
            ->with('success', 'Ciudad creada correctamente.');
    }

    /**
     * Muestra el formulario de edición (Route Model Binding).
     */
    public function edit(Ciudad $ciudad): View
    {
        // Pasamos el objeto $ciudad directamente gracias al Binding de Laravel
        $ciudades = Ciudad::latest('id')->get();

        return view('admin.Ciudad.index', compact('ciudad', 'ciudades'));

    }

    /**
     * Actualiza la ciudad en la base de datos.
     */
    public function update(UpdateCiudadRequest $request, Ciudad $ciudad): RedirectResponse
    {
        $ciudad->update($request->validated());

        return redirect()->route('admin.ciudad.index')
            ->with('success', 'Ciudad actualizada correctamente.');
    }

    /**
     * Elimina la ciudad.
     */
    public function destroy(Ciudad $ciudad): RedirectResponse
    {
        $ciudad->delete();

        return redirect()->route('admin.ciudad.index')
            ->with('success', 'Ciudad eliminada correctamente.');
    }
}
