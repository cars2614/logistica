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
        // Se unificó la validación con id_tipo_vehiculo y se añadieron textos legibles
        $request->validate([
            'placa'            => 'required|string|max:10|unique:vehiculos,placa',
            'marca'            => 'required|string|max:100',
            'modelo'           => 'required|string|max:100',
            'capacidad'        => 'required|numeric|min:1',
            'estado'           => 'required|in:activo,inactivo,mantenimiento',
            'fecha_registro'   => 'required|date',
            'id_tipo_vehiculo' => 'required|exists:tipo_vehiculo,id',
        ], [
            'placa.required'            => 'La placa vehicular es obligatoria.',
            'placa.unique'              => 'Esta placa ya se encuentra registrada en el sistema.',
            'placa.max'                 => 'La placa no puede superar los 10 caracteres.',
            'marca.required'            => 'La marca es obligatoria.',
            'modelo.required'           => 'El modelo es obligatorio.',
            'capacidad.required'        => 'La capacidad en kilos es obligatoria.',
            'capacidad.min'             => 'La capacidad debe ser mayor o igual a 1 kg.',
            'estado.required'           => 'El estado es obligatorio.',
            'estado.in'                 => 'El estado seleccionado no es válido.',
            'fecha_registro.required'   => 'La fecha de registro es obligatoria.',
            'fecha_registro.date'       => 'El formato de la fecha de registro no es válido.',
            'id_tipo_vehiculo.required' => 'Debe seleccionar un tipo de vehículo.',
            'id_tipo_vehiculo.exists'   => 'El tipo de vehículo seleccionado no existe en el sistema.',
        ]);

        Vehiculo::create($request->only([
            'placa', 'marca', 'modelo', 'capacidad',
            'estado', 'fecha_registro', 'id_tipo_vehiculo'
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
            'capacidad'        => 'required|numeric|min:1',
            'estado'           => 'required|in:activo,inactivo,mantenimiento',
            'fecha_registro'   => 'required|date',
            'id_tipo_vehiculo' => 'required|exists:tipo_vehiculo,id',
        ], [
            'placa.required'            => 'La placa vehicular es obligatoria.',
            'placa.unique'              => 'Esta placa ya está asignada a otro vehículo.',
            'marca.required'            => 'La marca es obligatoria.',
            'modelo.required'           => 'El modelo es obligatorio.',
            'capacidad.min'             => 'La capacidad debe ser mayor o igual a 1 kg.',
            'id_tipo_vehiculo.required' => 'Debe seleccionar un tipo de vehículo.',
        ]);

        $vehiculo->update($request->only([
            'placa', 'marca', 'modelo', 'capacidad',
            'estado', 'fecha_registro', 'id_tipo_vehiculo'
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