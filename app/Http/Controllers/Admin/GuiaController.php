<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guia;
use App\Models\Cliente;
use App\Models\TipoEntrega;
use App\Models\User;

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

        // 4. Traemos los repartidores
        $repartidores = User::whereHas('rol', function($q) { $q->where('nombreRol', 'Repartidor'); })->get();

        // 5. Enviamos todas las variables juntas a la vista
        return view('admin.guia.index', compact('guias', 'clientes', 'tipoEntregas', 'repartidores'));
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
            'id_repartidor'       => 'nullable|exists:users,id',
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
            'id_repartidor'      => $request->id_repartidor,



        ]);

        // 3. Redireccionamos con mensaje de éxito al listado
        return redirect()->route('admin.guia.index')->with('success', 'Guía creada correctamente.');
    }

    public function edit($id)
    {
        // 1. Buscamos la guía con sus relaciones actuales
        $guia = Guia::with(['clienteOrigen', 'clienteDestino', 'tipoEntrega'])->findOrFail($id);

        // 2. Traemos TODOS los clientes para los selects de Origen y Destino
        $clientes = Cliente::all();

        // 3. Traemos TODOS los tipos de entrega para el select correspondiente
        $tipoEntregas = TipoEntrega::all(); // Cambia 'TipoEntrega' por el nombre real de tu modelo

        // 4. Traemos los repartidores
        $repartidores = User::whereHas('rol', function($q) { $q->where('nombreRol', 'Repartidor'); })->get();

        return view('admin.guia.edit', compact('guia', 'clientes', 'tipoEntregas', 'repartidores'));
    }

    public function update(Request $request, $id)
    {
        $guia = Guia::findOrFail($id);

        $request->validate([
            'id_tipo_entrega'      => 'required|numeric',
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
            'id_repartidor'       => 'nullable|exists:users,id',
            
        ], [
            'id_tipo_entrega.required'    => 'El tipo de entrega es obligatorio.',
            'id_cliente_origen.required'   => 'El cliente de origen es obligatorio.',
            'id_cliente_destino.required'  => 'El cliente de destino es obligatorio.',
            'unidades.required'            => 'Las unidades son obligatorias.',
            'peso.required'                => 'El peso es obligatorio.',
            'largo.required'               => 'El largo es obligatorio.',
            'ancho.required'               => 'El ancho es obligatorio.',
            'alto.required'                => 'El alto es obligatorio.',
            'precio_envio.required'        => 'El precio de envío es obligatorio.',
            'valor_declarado.required'     => 'El valor declarado es obligatorio.',
            
        ]);

        $guia->update([
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
            'observacion'        => $request->observacion ?? '',
            'id_repartidor'      => $request->id_repartidor,
           
        ]);

        return redirect()->route('admin.guia.index')
            ->with('success', 'Guía actualizada correctamente.');
    }








}
