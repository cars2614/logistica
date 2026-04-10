<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = cliente::orderBy('created_at', 'desc')->get();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:100',
            'telefono'    => 'required|string|max:20',
            'correo'      => 'required|email|max:100|unique:clientes,correo',
            'direccion'   => 'required|string|max:200',
            'descripcion' => 'nullable|string|max:500',
        ], [
            'nombre.required'    => 'El nombre es obligatorio.',
            'telefono.required'  => 'El teléfono es obligatorio.',
            'correo.required'    => 'El correo es obligatorio.',
            'correo.email'       => 'El correo no tiene un formato válido.',
            'correo.unique'      => 'Este correo ya está registrado.',
            'direccion.required' => 'La dirección es obligatoria.',
        ]);

        cliente::create($request->only(['nombre', 'telefono', 'correo', 'direccion', 'descripcion']));

        return redirect()->route('admin.cliente.index')
            ->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cliente $cliente)
    {
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cliente $cliente)
    {
        $request->validate([
            'nombre'      => 'required|string|max:100',
            'telefono'    => 'required|string|max:20',
            'correo'      => 'required|email|max:100|unique:clientes,correo,' . $cliente->id,
            'direccion'   => 'required|string|max:200',
            'descripcion' => 'nullable|string|max:500',
        ], [
            'nombre.required'    => 'El nombre es obligatorio.',
            'telefono.required'  => 'El teléfono es obligatorio.',
            'correo.required'    => 'El correo es obligatorio.',
            'correo.email'       => 'El correo no tiene un formato válido.',
            'correo.unique'      => 'Este correo ya está registrado.',
            'direccion.required' => 'La dirección es obligatoria.',
        ]);

        $cliente->update($request->only(['nombre', 'telefono', 'correo', 'direccion', 'descripcion']));

        return redirect()->route('admin.cliente.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('admin.cliente.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}
