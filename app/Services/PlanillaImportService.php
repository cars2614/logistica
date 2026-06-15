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
        return DB::transaction(function () use ($rutaId, $excelFile) {
            
            // 1. Crear la Planilla base
            $planilla = Planilla::create([
                'numero_planilla' => 'PL-EXCEL-' . rand(1000, 9999) . '-' . time(),
                'id_ruta'         => $rutaId,
                'piezas'          => 0, // Se actualizará después de la importación
                'kilos'           => 0, // Se actualizará después de la importación
                'id_ciudad'       => Ciudad::first()->id ?? 1, // Por defecto la ciudad base
                'id_usuario'      => Auth::id() ?? 1,
            ]);

            // 2. Ejecutar la importación pesada del Excel
            $import = new GuiasImport($planilla);
            Excel::import($import, $excelFile);

            // 3. (Opcional) Actualizar la planilla con los totales reales del import
            $planilla->update([
                'piezas' => $import->getTotales()['piezas'],
                'kilos'  => $import->getTotales()['kilos'],
            ]);

            return [
                'planilla' => $planilla,
                'guias_creadas' => $import->getTotales()['guias_creadas']
            ];
        });
    }
}
