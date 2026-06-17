<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlanillaRequest;
use App\Models\Guia;
use App\Models\Planilla;
use App\Models\Ruta;
use App\Models\Vehiculo;
use App\Services\LogisticaService;
use App\Services\PlanillaImportService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Validators\ValidationException;

class PlanillaController extends Controller
{
    protected $logisticaService;

    public function __construct(LogisticaService $logisticaService)
    {
        $this->logisticaService = $logisticaService;
    }

    public function index()
    {
        $planillas = Planilla::orderBy('id', 'desc')->paginate(10);

        // Cargamos las guías junto con su cliente de origen
        $guias = Guia::with('clienteOrigen')->orderBy('id')->get();

        // Usamos el ID como identificador para la vista
        $rutas = Ruta::orderBy('id')->get();
        $vehiculos = Vehiculo::orderBy('id')->get();

        return view('admin.planillas.index', compact('planillas', 'guias', 'rutas', 'vehiculos'));
    }

    public function store(StorePlanillaRequest $request)
    {
        // Los datos ya están validados rigurosamente al llegar aquí
        $this->logisticaService->crearPlanillaDespacho($request->validated());

        // 4. Redireccionamos de vuelta a la vista index con mensaje de éxito
        return redirect()->route('admin.planilla.index')
            ->with('success', 'Planilla de despacho generada y blindada correctamente.');
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
        if (! file_exists($path)) {
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

        } catch (ValidationException $e) {
            // Manejo de errores fila por fila del Excel
            $failures = $e->failures();
            $errores = [];
            foreach ($failures as $failure) {
                $errores[] = 'Fila '.$failure->row().': '.implode(', ', $failure->errors());
            }

            return redirect()->back()->withErrors($errores)->with('error', 'El archivo Excel contiene errores de validación.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al importar: '.$e->getMessage());
        }
    }
}
