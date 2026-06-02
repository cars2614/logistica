<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guia;
use App\Models\Cliente;
use App\Models\TipoEntrega;
use Illuminate\Http\Request;

class GuiaController extends Controller
{
    public function index()
    {
        // 1. Carga las guías con paginación
        $guias = Guia::with(['clienteOrigen', 'clienteDestino', 'tipoEntrega'])->paginate(10);
        
        // 2. Traemos todos los clientes de la BD para el formulario modal
        $clientes = Cliente::all();
        
        // 3. Traemos los tipos de entrega por si tu formulario los necesita
        $tipoEntregas = TipoEntrega::all();
        
        // 4. Enviamos todas las variables juntas a la vista
        return view('admin.guia.index', compact('guias', 'clientes', 'tipoEntregas'));
    }

    public function store(Request $request)
    {
        // 1. Validamos los datos tal como vienen del formulario en la pantalla
        $request->validate([
            'num_guias'       => 'required|integer',
            'volumen'         => 'required|numeric',
            'peso'            => 'required|numeric',
            'precio'          => 'required|numeric',
            'fecha_admision'  => 'required|date',
            'unidades'        => 'required|integer|min:1',
            'cliente_id'      => 'required|exists:clientes,id',
            'tipo_entrega_id' => 'required|exists:tipo_entregas,id',
            'observacion'     => 'nullable|string|max:255',
        ]);

        // 2. Creamos la guía mapeando los inputs a las columnas reales de la BD
        Guia::create([
            'num_guias'          => $request->num_guias,
            'volumen'            => $request->volumen,
            'peso'               => $request->peso,
            'precio'             => $request->precio,
            'observacion'        => $request->observacion ?? 'Ninguna',
            'fecha_admision'     => $request->fecha_admision,
            'unidades'           => $request->unidades,
            'id_cliente_origen'  => $request->cliente_id, 
            'id_cliente_destino' => $request->cliente_id, 
            'id_tipo_entrega'    => $request->tipo_entrega_id,
        ]);

        // 3. Redireccionamos con mensaje de éxito al listado
        return redirect()->route('admin.guia.index')->with('success', 'Guía creada correctamente.');
    }
}