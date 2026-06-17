<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Ciudad;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('ciudad')->orderBy('created_at', 'desc')->get();
        $ciudades = Ciudad::orderBy('nombre', 'asc')->get();

        return view('admin.cliente.index', compact('clientes', 'ciudades'));
    }

    public function store(StoreClienteRequest $request)
    {
        $data = $request->validated();
        if (! isset($data['descripcion'])) {
            $data['descripcion'] = '';
        }

        Cliente::create($data);

        return redirect()->route('admin.cliente.index')
            ->with('success', 'Cliente creado correctamente.');
    }

    public function edit(Cliente $cliente)
    {
        $ciudades = Ciudad::orderBy('nombre', 'asc')->get();

        return view('admin.cliente.edit', compact('cliente', 'ciudades'));
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $data = $request->validated();
        if (! isset($data['descripcion'])) {
            $data['descripcion'] = '';
        }

        $cliente->update($data);

        return redirect()->route('admin.cliente.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('admin.cliente.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}
