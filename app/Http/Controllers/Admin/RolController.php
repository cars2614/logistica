<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'nombreRol' => ucfirst(strtolower(trim($request->nombreRol)))
        ]);

        $request->validate([
            'nombreRol' => 'required|string|max:100|unique:roles,name',
        ], [
            'nombreRol.required' => 'El nombre del rol es obligatorio.',
            'nombreRol.unique'   => 'Este rol ya existe.',
            'nombreRol.max'      => 'El nombre no puede superar 100 caracteres.',
        ]);

        Role::create(['name' => $request->nombreRol]);

        return redirect()->route('admin.rol.index')
            ->with('success', 'Rol creado correctamente.');
    }

    public function edit(Role $rol)
    {
        return view('admin.roles.edit', compact('rol'));
    }

    public function update(Request $request, Role $rol)
    {
        $request->merge([
            'nombreRol' => ucfirst(strtolower(trim($request->nombreRol)))
        ]);

        $request->validate([
            'nombreRol' => 'required|string|max:100|unique:roles,name,' . $rol->id,
        ], [
            'nombreRol.required' => 'El nombre del rol es obligatorio.',
            'nombreRol.unique'   => 'Este rol ya existe.',
            'nombreRol.max'      => 'El nombre no puede superar 100 caracteres.',
        ]);

        $rol->update(['name' => $request->nombreRol]);

        return redirect()->route('admin.rol.index')
            ->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $rol)
    {
        $rol->delete();
        return redirect()->route('admin.rol.index')
            ->with('success', 'Rol eliminado correctamente.');
    }
}