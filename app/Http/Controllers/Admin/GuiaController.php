<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guia;
use App\Models\Cliente;
use App\Models\TipoEntrega;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GuiaController extends Controller
{
    public function index()
    {
        // 1. Carga las guías con paginación
        /* $guias = Guia::with(['clienteOrigen', 'clienteDestino', 'tipoEntrega'])->paginate(10); */

        $guias = Guia::with(['clienteOrigen', 'clienteDestino', 'tipoEntrega'])->get();

        /* $guias = Guia::with(['clienteOrigen', 'clienteDestino'])->get(); */
 
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

            'id_tipo_entrega'     => 'required|numeric',
            'id_cliente_origen'   => 'required|exists:clientes,id',
            'id_cliente_destino'  => 'required|exists:clientes,id',
            'unidades'            => 'required|integer|min:1',
            'peso'                => 'required|numeric',

            'largo'               => 'required|numeric',
            'ancho'               => 'required|numeric',
            'alto'                => 'required|numeric',
            'precio_envio'        => 'required|numeric',
            'valor_declarado'     => 'required|numeric',

            'observacion'         => 'nullable|string|max:255',
        ]);

        // 2. Creamos la guía mapeando los inputs a las columnas reales de la BD
        Guia::create([

            'id_tipo_entrega'    => $request->id_tipo_entrega,
            'id_cliente_origen'  => $request->id_cliente_origen,
            'id_cliente_destino' => $request->id_cliente_destino,
            'unidades'           => $request->unidades,
            'peso'               => $request->peso,
            'largo'              => $request->largo,
            'ancho'              => $request->ancho,
            'alto'               => $request->alto,
            'precio_envio'       => $request->precio_envio,
            'valor_declarado'    => $request->valor_declarado,
            'observacion'        => $request->observacion ?? 'Ninguna',



        ]);

        // 3. Redireccionamos con mensaje de éxito al listado
        return redirect()->route('admin.guia.index')->with('success', 'Guía creada correctamente.');
    }
}
