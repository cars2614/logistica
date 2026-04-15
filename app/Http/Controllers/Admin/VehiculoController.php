<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use App\Models\TipoVehiculo;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos     = Vehiculo::with('tipoVehiculo')->orderBy('placa')->paginate(10);
        $tipoVehiculos = TipoVehiculo::orderBy('nombre')->get();
        return view('admin.vehiculo.index', compact('vehiculos', 'tipoVehiculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa'            => 'required|string|max:10|unique:vehiculos,placa',
            'marca'            => 'required|string|max:100',
            'modelo'           => 'required|string|max:100',
            'capacidad'        => 'required|numeric|min:0',
            'estado'           => 'required|in:activo,inactivo,mantenimiento',
            'fecha_registro'   => 'required|date',
            'tipo_vehiculo_id' => 'required|exists:tipo_vehiculo,id',
        ]);

        Vehiculo::create($request->only([
            'placa', 'marca', 'modelo', 'capacidad',
            'estado', 'fecha_registro', 'tipo_vehiculo_id'
        ]));

        return redirect()->route('admin.vehiculo.index')
            ->with('success', 'Vehículo registrado correctamente.');
    }

    public function edit($id)
    {
        $vehiculo      = Vehiculo::findOrFail($id);
        $tipoVehiculos = TipoVehiculo::orderBy('nombre')->get();
        return view('admin.vehiculo.edit', compact('vehiculo', 'tipoVehiculos'));
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $request->validate([
            'placa'            => 'required|string|max:10|unique:vehiculos,placa,' . $id,
            'marca'            => 'required|string|max:100',
            'modelo'           => 'required|string|max:100',
            'capacidad'        => 'required|numeric|min:0',
            'estado'           => 'required|in:activo,inactivo,mantenimiento',
            'fecha_registro'   => 'required|date',
            'tipo_vehiculo_id' => 'required|exists:tipo_vehiculo,id',
        ]);

        $vehiculo->update($request->only([
            'placa', 'marca', 'modelo', 'capacidad',
            'estado', 'fecha_registro', 'tipo_vehiculo_id'
        ]));

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