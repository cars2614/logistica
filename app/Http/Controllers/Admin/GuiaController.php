<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guia;
use App\Models\Cliente;
use App\Models\TipoEntrega;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class GuiaController extends Controller
{
    public function index()
    {
        $guias        = Guia::with(['cliente', 'tipoEntrega'])->orderBy('id_guias', 'desc')->paginate(10);
        $clientes     = Cliente::orderBy('nombre')->get();
        $tipoEntregas = TipoEntrega::orderBy('nombre')->get();

        return view('admin.guia.index', compact('guias', 'clientes', 'tipoEntregas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'num_guias'       => 'required|integer',
            'volumen'         => 'required|numeric|min:0',
            'peso'            => 'required|numeric|min:0',
            'precio'          => 'required|numeric|min:0',
            'observacion'     => 'nullable|string|max:255',
            'fecha_admision'  => 'required|date',
            'unidades'        => 'required|integer|min:1',
            'cliente_id'      => 'required|exists:clientes,id',
            'tipo_entrega_id' => 'required|exists:tipo_entregas,id',
        ]);

        Guia::create($request->only([
            'num_guias', 'volumen', 'peso', 'precio',
            'observacion', 'fecha_admision', 'unidades',
            'cliente_id', 'tipo_entrega_id',
        ]));

        return redirect()->route('admin.guia.index')
            ->with('success', 'Guía creada correctamente.');
    }

    public function edit($id)
    {
        $guia         = Guia::findOrFail($id);
        $clientes     = Cliente::orderBy('nombre')->get();
        $tipoEntregas = TipoEntrega::orderBy('nombre')->get();

        return view('admin.guia.edit', compact('guia', 'clientes', 'tipoEntregas'));
    }

    public function update(Request $request, $id)
    {
        $guia = Guia::findOrFail($id);

        $request->validate([
            'num_guias'       => 'required|integer',
            'volumen'         => 'required|numeric|min:0',
            'peso'            => 'required|numeric|min:0',
            'precio'          => 'required|numeric|min:0',
            'observacion'     => 'nullable|string|max:255',
            'fecha_admision'  => 'required|date',
            'unidades'        => 'required|integer|min:1',
            'cliente_id'      => 'required|exists:clientes,id',
            'tipo_entrega_id' => 'required|exists:tipo_entregas,id',
        ]);

        $guia->update($request->only([
            'num_guias', 'volumen', 'peso', 'precio',
            'observacion', 'fecha_admision', 'unidades',
            'cliente_id', 'tipo_entrega_id',
        ]));

        return redirect()->route('admin.guia.index')
            ->with('success', 'Guía actualizada correctamente.');
    }

    public function destroy($id)
    {
        $guia = Guia::findOrFail($id);

        try {
            $guia->delete();
            return redirect()->route('admin.guia.index')
                ->with('success', 'Guía eliminada correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('admin.guia.index')
                ->with('error', 'No se puede eliminar esta guía porque tiene registros asociados.');
        }
    }
}