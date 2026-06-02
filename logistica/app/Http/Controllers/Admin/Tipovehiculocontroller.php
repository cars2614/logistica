<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoVehiculo;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TipovehiculoController extends Controller
{
    public function index()
    {
        $tipoVehiculos = TipoVehiculo::orderBy('nombre')->paginate(10);
        return view('admin.tipo-vehiculo.index', compact('tipoVehiculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'nombre' => 'required|string|max:100|unique:tipo_vehiculo,nombre',
            'descripcion' => 'nullable|string|max:255',
        ]);

        TipoVehiculo::create($request->only('nombre', 'descripcion'));

        return redirect()->route('admin.tipo-vehiculo.index')
            ->with('success', 'Tipo de vehículo creado correctamente.');
    }

    public function edit($id)
    {
        $tipoVehiculo = TipoVehiculo::findOrFail($id);
        return view('admin.tipo-vehiculo.edit', compact('tipoVehiculo'));
    }

    public function update(Request $request, $id)
    {
        $tipoVehiculo = TipoVehiculo::findOrFail($id);

        $request->validate([
          'nombre' => 'required|string|max:100|unique:tipo_vehiculo,nombre,' . $id,

            'descripcion' => 'nullable|string|max:255',
        ]);

        $tipoVehiculo->update($request->only('nombre', 'descripcion'));

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
            // Si el registro tiene relaciones (FK), se muestra un mensaje amigable
            return redirect()->route('admin.tipo-vehiculo.index')
                ->with('error', 'No se puede eliminar este tipo de vehículo porque tiene registros asociados.');
        }
    }
}