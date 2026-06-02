<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Muestra el listado de roles.
     */
    public function index()
    {
        $roles = Rol::orderBy('created_at', 'desc')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Guarda un nuevo rol en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Validamos 'nombreRol' que es el nombre en tu tabla 'rols'
            'nombreRol' => 'required|string|max:100|unique:rols,nombreRol',
        ], [
            'nombreRol.required' => 'El nombre del rol es obligatorio.',
            'nombreRol.unique'   => 'Este rol ya existe.',
            'nombreRol.max'      => 'El nombre no puede superar 100 caracteres.',
        ]);

        // Guardamos usando el nombre correcto de la columna
        Rol::create($request->only('nombreRol'));

        return redirect()->route('admin.rol.index') // Ajustado a tu ruta estándar
            ->with('success', 'Rol creado correctamente.');
    }

    /**
     * Muestra el formulario de edición.
     */
    public function edit(Rol $rol)
    {
        return view('admin.roles.edit', compact('rol'));
    }

    /**
     * Actualiza el rol.
     */
    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            // Corregido para usar 'nombreRol' y la tabla 'rols'
            'nombreRol' => 'required|string|max:100|unique:rols,nombreRol,' . $rol->id,
        ], [
            'nombreRol.required' => 'El nombre del rol es obligatorio.',
            'nombreRol.unique'   => 'Este rol ya existe.',
            'nombreRol.max'      => 'El nombre no puede superar 100 caracteres.',
        ]);

        $rol->update($request->only('nombreRol'));

        return redirect()->route('admin.rol.index')
            ->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Elimina el rol.
     */
    public function destroy(Rol $rol)
    {
        $rol->delete();

        return redirect()->route('admin.rol.index')
            ->with('success', 'Rol eliminado correctamente.');
    }
}