<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Planilla;
use App\Models\Guia;
use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\PlanillaImportService;

class PlanillaController extends Controller
{
    public function index()
    {
        $planillas = Planilla::orderBy('id', 'desc')->paginate(10);
        
        // Cargamos las guías junto con su cliente de origen
        $guias = Guia::with('clienteOrigen')->orderBy('id')->get();
        
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

        // 3. Guardamos el registro usando el modelo original
        Planilla::create($datosParaBD);

        // 4. Redireccionamos de vuelta a la vista index con mensaje de éxito
        return redirect()->route('admin.planilla.index')
            ->with('success', 'Planilla creada correctamente.');
    }

    public function edit($id)
    {
        $planilla = Planilla::with(['guias.clienteOrigen', 'guias.clienteDestino', 'guias.estados', 'ruta'])
            ->findOrFail($id);

        $rutas = Ruta::orderBy('id')->get();
        $guias = Guia::with('clienteOrigen')->orderBy('id')->get();

        return view('admin.planillas.edit', compact('planilla', 'rutas', 'guias'));
    }

    public function destroy($id)
    {
        $planilla = Planilla::findOrFail($id);
        $planilla->delete();

        return redirect()->route('admin.planilla.index')
            ->with('success', 'Planilla eliminada correctamente.');
    }

    public function descargarPlantilla()
    {
        $path = public_path('templates/plantilla_guias.xlsx');
        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'La plantilla aún no está disponible.');
        }
        return response()->download($path);
    }

    public function importarExcel(Request $request, PlanillaImportService $importService)
    {
        // Aumentar tiempo y memoria para procesar archivos Excel grandes
        set_time_limit(300); // 5 minutos máximo
        ini_set('memory_limit', '256M');

        $request->validate([
            'id_ruta' => 'required|exists:rutas,id',
            'excel' => 'required|mimes:xlsx,xls,csv|max:5120', // Max 5MB
        ]);

        try {
            $resultado = $importService->importarYCrearPlanilla($request->id_ruta, $request->file('excel'));
            
            return redirect()->route('admin.planilla.index')
                ->with('success', "¡Éxito! Planilla creada y {$resultado['guias_creadas']} guías importadas correctamente.");
                
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Manejo de errores fila por fila del Excel
            $failures = $e->failures();
            $errores = [];
            foreach ($failures as $failure) {
                $errores[] = "Fila " . $failure->row() . ": " . implode(', ', $failure->errors());
            }
            return redirect()->back()->withErrors($errores)->with('error', 'El archivo Excel contiene errores de validación.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al importar: ' . $e->getMessage());
        }
    }
}