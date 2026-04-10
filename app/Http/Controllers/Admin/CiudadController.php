<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ciudad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre'        => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:20',
        ], [
            'nombre.required'        => 'El nombre es obligatorio.',
            'codigo_postal.required' => 'El código postal es obligatorio.',
        ]);

        Ciudad::create($validated);

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
    public function update(Request $request, Ciudad $ciudad): RedirectResponse
    {
        $validated = $request->validate([
            'nombre'        => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:20',
        ], [
            'nombre.required'        => 'El nombre es obligatorio.',
            'codigo_postal.required' => 'El código postal es obligatorio.',
        ]);

        $ciudad->update($validated);

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