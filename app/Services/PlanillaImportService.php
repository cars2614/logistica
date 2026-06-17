<?php

namespace App\Services;

use App\Models\Planilla;
use App\Models\Ciudad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuiasImport;

class PlanillaImportService
{
    /**
     * Orquesta la creación de la planilla y la importación de las guías
     *
     * @param int $rutaId
     * @param \Illuminate\Http\UploadedFile $excelFile
     * @return array
     */
    public function importarYCrearPlanilla($rutaId, $excelFile)
    {
        // 1. Crear la Planilla base
        $planilla = Planilla::create([
            'numero_planilla' => 'PL-EXCEL-' . rand(1000, 9999) . '-' . time(),
            'id_ruta'         => $rutaId,
            'piezas'          => 0, // Se actualizará en background
            'kilos'           => 0, // Se actualizará en background
            'id_ciudad'       => Ciudad::first()->id ?? 1, // Por defecto la ciudad base
            'id_usuario'      => Auth::id() ?? 1,
        ]);

        // 2. Ejecutar la importación en segundo plano (ShouldQueue)
        $import = new GuiasImport($planilla);
        Excel::import($import, $excelFile);

        return [
            'planilla' => $planilla,
            'guias_creadas' => 'en proceso (background)'
        ];
    }
}
