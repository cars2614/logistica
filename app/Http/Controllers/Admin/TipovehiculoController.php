<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTipovehiculoRequest;
use App\Http\Requests\UpdateTipovehiculoRequest;
use App\Models\TipoVehiculo;
use Illuminate\Database\QueryException;

class TipovehiculoController extends Controller
{
    public function index()
    {
        $tipoVehiculos = TipoVehiculo::orderBy('nombre')->paginate(10);

        return view('admin.tipo-vehiculo.index', compact('tipoVehiculos'));
    }

    public function store(StoreTipovehiculoRequest $request)
    {
        $data = $request->validated();
        if (! isset($data['descripcion'])) {
            $data['descripcion'] = '';
        }

        TipoVehiculo::create($data);

        return redirect()->route('admin.tipo-vehiculo.index')
            ->with('success', 'Tipo de vehículo creado correctamente.');
    }

    public function edit($id)
    {
        $tipoVehiculo = TipoVehiculo::findOrFail($id);

        return view('admin.tipo-vehiculo.edit', compact('tipoVehiculo'));
    }

    public function update(UpdateTipovehiculoRequest $request, $id)
    {
        $tipoVehiculo = TipoVehiculo::findOrFail($id);
        $data = $request->validated();
        if (! isset($data['descripcion'])) {
            $data['descripcion'] = '';
        }

        $tipoVehiculo->update($data);

        return redirect()->route('admin.tipo-vehiculo.index')
            ->with('success', 'Tipo de vehículo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $tipoVehiculo = TipoVehiculo::findOrFail($id);

        try {
            $tipoVehiculo->delete();

            return redirect()->route('admin.tipo-vehiculo.index')
                ->with('success', 'Tipo de vehículo eliminado correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('admin.tipo-vehiculo.index')
                ->with('error', 'No se puede eliminar este tipo de vehículo porque tiene registros asociados.');
        }
    }
}
