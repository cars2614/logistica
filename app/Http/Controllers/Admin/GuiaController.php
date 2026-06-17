<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuiaRequest;
use App\Http\Requests\UpdateGuiaRequest;
use App\Models\Cliente;
use App\Models\Guia;
use App\Models\TipoEntrega;
use App\Models\User;
use App\Services\LogisticaService;
use Illuminate\Http\Request;

class GuiaController extends Controller
{
    protected $logisticaService;

    public function __construct(LogisticaService $logisticaService)
    {
        $this->logisticaService = $logisticaService;
    }

    public function index()
    {
        // 1. Carga las guías con paginación
        $guias = Guia::with(['clienteOrigen', 'clienteDestino', 'tipoEntrega', 'repartidor', 'estadoActual'])->get();

        // 2. Traemos todos los clientes de la BD para el formulario modal
        $clientes = Cliente::all();

        // 3. Traemos los tipos de entrega por si tu formulario los necesita
        $tipoEntregas = TipoEntrega::all();

        // 4. Traemos los repartidores
        $repartidores = User::role(RoleEnum::REPARTIDOR->value)->get();

        // 5. Enviamos todas las variables juntas a la vista
        return view('admin.guia.index', compact('guias', 'clientes', 'tipoEntregas', 'repartidores'));
    }

    public function store(StoreGuiaRequest $request)
    {
        // 1. Validamos los datos tal como vienen del formulario en la pantalla a través de StoreGuiaRequest

        // 2. Creamos la guía mapeando los inputs validados a las columnas reales de la BD
        $guia = new Guia([
            'id_tipo_entrega' => $request->id_tipo_entrega,
            'id_cliente_origen' => $request->id_cliente_origen,
            'id_cliente_destino' => $request->id_cliente_destino,
            'unidades' => $request->unidades,
            'peso' => $request->peso,
            'largo' => $request->largo,
            'ancho' => $request->ancho,
            'alto' => $request->alto,
            'precio_envio' => $request->precio_envio,
            'valor_declarado' => $request->valor_declarado,
            'observacion' => $request->observacion ?? 'Ninguna',
        ]);
        $guia->id_repartidor = $request->id_repartidor;
        $guia->estado_actual = 'Bodega'; // Estado por defecto
        $guia->save();

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
        $tipoEntregas = TipoEntrega::all();

        // 4. Traemos los repartidores
        $repartidores = User::role(RoleEnum::REPARTIDOR->value)->get();

        return view('admin.guia.edit', compact('guia', 'clientes', 'tipoEntregas', 'repartidores'));
    }

    public function update(UpdateGuiaRequest $request, $id)
    {
        $guia = Guia::findOrFail($id);

        $guia->update([
            'id_tipo_entrega' => $request->id_tipo_entrega,
            'id_cliente_origen' => $request->id_cliente_origen,
            'id_cliente_destino' => $request->id_cliente_destino,
            'unidades' => $request->unidades,
            'peso' => $request->peso,
            'largo' => $request->largo,
            'ancho' => $request->ancho,
            'alto' => $request->alto,
            'precio_envio' => $request->precio_envio,
            'valor_declarado' => $request->valor_declarado,
            'observacion' => $request->observacion ?? '',
            'id_repartidor' => $request->id_repartidor,
        ]);

        return redirect()->route('admin.guia.index')
            ->with('success', 'Guía actualizada correctamente.');
    }

    public function destroy($id)
    {
        $guia = Guia::findOrFail($id);
        $guia->delete(); // SoftDelete — no elimina de la BD

        return redirect()->route('admin.guia.index')
            ->with('success', 'Guía eliminada correctamente.');
    }

    public function actualizarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ]);

        try {
            $this->logisticaService->cambiarEstadoGuia($id, $request->estado, $request->descripcion);

            return redirect()->back()->with('success', 'Estado actualizado y auditado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el estado: '.$e->getMessage());
        }
    }
}
