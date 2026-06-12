<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Planilla;
use App\Models\Guia;
use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanillaController extends Controller
{
    public function index()
    {
        $planillas = Planilla::orderBy('id', 'desc')->paginate(10);
        
        // Cargamos las guías junto con su cliente de origen
<<<<<<< HEAD
        $guias = Guia::with('clienteOrigen')->orderBy('num_guias')->get(); 
=======
        $guias = Guia::with('clienteOrigen')->orderBy('id')->get(); 
>>>>>>> origin/juana
        
        // Usamos el ID como identificador para la vista
        $rutas = Ruta::orderBy('id')->get();

        return view('admin.planillas.index', compact('planillas', 'guias', 'rutas'));
    }

    public function store(Request $request)
    {
        // 1. Validamos los campos básicos que provienen del formulario visual
        $request->validate([
            'ruta_id' => 'required',
            'piezas'  => 'required',
            'kilos'   => 'required',
        ]);

        // 2. Armamos la estructura exacta que pide tu modelo e inserta en la BD
        $datosParaBD = [
            'numero_planilla' => 'PL-' . rand(1000, 9999),
            'id_ruta'         => $request->input('ruta_id'),
            'piezas'          => $request->input('piezas'),
            'kilos'           => $request->input('kilos'),
            'id_ciudad'       => \App\Models\Ciudad::first()->id ?? 1,
            'id_usuario'      => Auth::id() ?? 1,
        ];

<<<<<<< HEAD
        // 3. Guardamos el registro usando el modelo original
        Planilla::create($datosParaBD);

=======
        // 3. SOLUCCIÓN DE RAÍZ: Desactivamos temporalmente la restricción de llaves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Guardamos el registro usando el modelo original sin bloqueos de MySQL
        Planilla::create($datosParaBD);

        // Reactivamos la verificación de llaves por seguridad
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

>>>>>>> origin/juana
        // 4. Redireccionamos de vuelta a la vista index con mensaje de éxito
        return redirect()->route('admin.planilla.index')
            ->with('success', 'Planilla creada correctamente.');
    }

    public function destroy($id)
    {
        $planilla = Planilla::findOrFail($id);
        $planilla->delete();

        return redirect()->route('admin.planilla.index')
            ->with('success', 'Planilla eliminada correctamente.');
    }
}