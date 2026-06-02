<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::orderBy('created_at', 'desc')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        // Normalizar: primera letra mayúscula, resto minúsculas
        $request->merge([
            'nombreRol' => ucfirst(strtolower(trim($request->nombreRol)))
        ]);

        $request->validate([
            'nombreRol' => 'required|string|max:100|unique:rols,nombreRol',
        ], [
            'nombreRol.required' => 'El nombre del rol es obligatorio.',
            'nombreRol.unique'   => 'Este rol ya existe.',
            'nombreRol.max'      => 'El nombre no puede superar 100 caracteres.',
        ]);

        Rol::create($request->only('nombreRol'));

        return redirect()->route('admin.rol.index')
            ->with('success', 'Rol creado correctamente.');
    }

    public function edit(Rol $rol)
    {
        return view('admin.roles.edit', compact('rol'));
    }

    public function update(Request $request, Rol $rol)
    {
        // Normalizar: primera letra mayúscula, resto minúsculas
        $request->merge([
            'nombreRol' => ucfirst(strtolower(trim($request->nombreRol)))
        ]);

        $request->validate([
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

    public function destroy(Rol $rol)
    {
        $rol->delete();
        return redirect()->route('admin.rol.index')
            ->with('success', 'Rol eliminado correctamente.');
    }
}