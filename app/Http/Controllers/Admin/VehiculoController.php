<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehiculoRequest;
use App\Http\Requests\UpdateVehiculoRequest;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Database\QueryException;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::with('tipoVehiculo')->orderBy('placa')->paginate(10);
        $tipoVehiculos = TipoVehiculo::orderBy('nombre')->get();

        return view('admin.vehiculo.index', compact('vehiculos', 'tipoVehiculos'));
    }

    public function store(StoreVehiculoRequest $request)
    {
        Vehiculo::create($request->validated());

        return redirect()->route('admin.vehiculo.index')
            ->with('success', 'Vehículo registrado correctamente.');
    }

    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $tipoVehiculos = TipoVehiculo::orderBy('nombre')->get();

        return view('admin.vehiculo.edit', compact('vehiculo', 'tipoVehiculos'));
    }

    public function update(UpdateVehiculoRequest $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->update($request->validated());

        return redirect()->route('admin.vehiculo.index')
            ->with('success', 'Vehículo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        try {
            $vehiculo->delete();

            return redirect()->route('admin.vehiculo.index')
                ->with('success', 'Vehículo eliminado correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('admin.vehiculo.index')
                ->with('error', 'No se puede eliminar este vehículo porque tiene registros asociados.');
        }
    }
}
