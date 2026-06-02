<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ciudad;
use App\Models\cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = cliente::orderBy('created_at', 'desc')->get();
        $ciudades = ciudad::orderBy('nombre', 'asc')->get();
        return view('admin.clientes.index', compact('clientes', 'ciudades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cedula'      => 'required|string|max:20|unique:clientes,cedula',
            'nombre'      => 'required|string|max:100',
            'telefono'    => 'required|string|max:20',
            'correo'      => 'required|email|max:100|unique:clientes,correo',
            'direccion'   => 'required|string|max:200',
            'descripcion' => 'nullable|string|max:500',
            'id_ciudad'   => 'required|exists:ciudades,id',
        ], [
            'cedula.required'    => 'La cédula es obligatoria.',
            'cedula.unique'      => 'Esta cédula ya está registrada.',
            'cedula.max'         => 'La cédula no puede superar 20 caracteres.',
            'nombre.required'    => 'El nombre es obligatorio.',
            'telefono.required'  => 'El teléfono es obligatorio.',
            'correo.required'    => 'El correo es obligatorio.',
            'correo.email'       => 'El correo no tiene un formato válido.',
            'correo.unique'      => 'Este correo ya está registrado.',
            'direccion.required' => 'La dirección es obligatoria.',
            'id_ciudad.required' => 'La ciudad es obligatoria.',
        ]);

        cliente::create([
            'cedula'      => $request->cedula,
            'nombre'      => $request->nombre,
            'telefono'    => $request->telefono,
            'correo'      => $request->correo,
            'direccion'   => $request->direccion,
            'descripcion' => $request->descripcion ?? '',
            'id_ciudad'   => $request->id_ciudad,
        ]);

        return redirect()->route('admin.cliente.index')
            ->with('success', 'Cliente creado correctamente.');
    }

    public function edit(cliente $cliente)
    {
        $ciudades = ciudad::orderBy('nombre', 'asc')->get();
        return view('admin.clientes.edit', compact('cliente', 'ciudades'));
    }

    public function update(Request $request, cliente $cliente)
    {
        $request->validate([
            'cedula'      => 'required|string|max:20|unique:clientes,cedula,' . $cliente->id,
            'nombre'      => 'required|string|max:100',
            'telefono'    => 'required|string|max:20',
            'correo'      => 'required|email|max:100|unique:clientes,correo,' . $cliente->id,
            'direccion'   => 'required|string|max:200',
            'descripcion' => 'nullable|string|max:500',
            'id_ciudad'   => 'required|exists:ciudades,id',
        ], [
            'cedula.required'    => 'La cédula es obligatoria.',
            'cedula.unique'      => 'Esta cédula ya está registrada.',
            'nombre.required'    => 'El nombre es obligatorio.',
            'telefono.required'  => 'El teléfono es obligatorio.',
            'correo.required'    => 'El correo es obligatorio.',
            'correo.email'       => 'El correo no tiene un formato válido.',
            'correo.unique'      => 'Este correo ya está registrado.',
            'direccion.required' => 'La dirección es obligatoria.',
            'id_ciudad.required' => 'La ciudad es obligatoria.',
        ]);

        $cliente->update([
            'cedula'      => $request->cedula,
            'nombre'      => $request->nombre,
            'telefono'    => $request->telefono,
            'correo'      => $request->correo,
            'direccion'   => $request->direccion,
            'descripcion' => $request->descripcion ?? '',
            'id_ciudad'   => $request->id_ciudad,
        ]);

        return redirect()->route('admin.cliente.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('admin.cliente.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}