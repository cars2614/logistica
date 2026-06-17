<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RutaController extends Controller
{
    public function index()
    {
        $rutas = Ruta::orderBy('zona')->paginate(10);

        return view('admin.ruta.index', compact('rutas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'zona'      => 'required|string|max:255',
            'guia'      => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'sector'    => 'required|string|max:255',
            'ciudad'    => 'required|string|max:255',
        ]);

        // Capturamos los datos que pasaron la validación
        $datos = $request->only(['zona', 'guia', 'direccion', 'sector', 'ciudad']);
        
        // Parche: Llenamos 'descripcion' con un string vacío para satisfacer a la BD vieja
        $datos['descripcion'] = ''; 

        Ruta::create($datos);

        return redirect()->route('admin.ruta.index')
            ->with('success', 'Ruta creada correctamente.');
    }

    public function edit($id)
    {
        $ruta = Ruta::findOrFail($id);

        return view('admin.ruta.edit', compact('ruta'));
    }

    public function update(Request $request, $id)
    {
        $ruta = Ruta::findOrFail($id);

        $request->validate([
            'zona'      => 'required|string|max:255',
            'guia'      => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'sector'    => 'required|string|max:255',
            'ciudad'    => 'required|string|max:255',
        ]);

        // Capturamos los datos para actualizar
        $datos = $request->only(['zona', 'guia', 'direccion', 'sector', 'ciudad']);
        
        // Parche: Mantenemos el campo feliz en la actualización también
        $datos['descripcion'] = ''; 

        $ruta->update($datos);

        return redirect()->route('admin.ruta.index')
            ->with('success', 'Ruta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $ruta = Ruta::findOrFail($id);

        try {
            $ruta->delete();
            return redirect()->route('admin.ruta.index')
                ->with('success', 'Ruta eliminada correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('admin.ruta.index')
                ->with('error', 'No se puede eliminar esta ruta porque tiene planillas asociadas.');
        }
    }
}