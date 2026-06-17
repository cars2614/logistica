<?php

namespace App\Imports;

use App\Models\Guia;
use App\Models\Cliente;
use App\Models\TipoEntrega;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class GuiasImport implements ToCollection, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading, ShouldQueue, SkipsEmptyRows
{
    protected $planilla;
    protected $ciudadId;
    protected $tipoEntregaId;

    public function __construct($planilla)
    {
        $this->planilla = $planilla;
        $this->ciudadId = \App\Models\Ciudad::first()?->id ?? 1;
        $this->tipoEntregaId = TipoEntrega::first()?->id ?? 1;
    }

    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $row) {
                
                // 1. Gestionar Cliente Origen
                $clienteOrigen = Cliente::firstOrCreate(
                    ['cedula' => $row['cedula_origen']],
                    [
                        'nombre' => $row['nombre_origen'],
                        'telefono' => $row['telefono_origen'] ?? '0000000000',
                        'correo' => $row['correo_origen'] ?? 'sin-correo@logistica.com',
                        'direccion' => $row['direccion_origen'] ?? 'No especificada',
                        'id_ciudad' => $this->ciudadId,
                    ]
                );

                // 2. Gestionar Cliente Destino
                $clienteDestino = Cliente::firstOrCreate(
                    ['cedula' => $row['cedula_destino']],
                    [
                        'nombre' => $row['nombre_destino'],
                        'telefono' => $row['telefono_destino'] ?? '0000000000',
                        'correo' => $row['correo_destino'] ?? 'sin-correo@logistica.com',
                        'direccion' => $row['direccion_destino'] ?? 'No especificada',
                        'id_ciudad' => $this->ciudadId,
                    ]
                );

                // 3. Crear Guía
                $guia = Guia::create([
                    'id_cliente_origen' => $clienteOrigen->id,
                    'id_cliente_destino' => $clienteDestino->id,
                    'id_tipo_entrega' => $this->tipoEntregaId,
                    'unidades' => $row['piezas'],
                    'peso' => $row['peso'],
                    'largo' => $row['largo'] ?? 1,
                    'ancho' => $row['ancho'] ?? 1,
                    'alto' => $row['alto'] ?? 1,
                    'precio_envio' => $row['precio_envio'] ?? 0,
                    'valor_declarado' => $row['valor_declarado'] ?? 0,
                    'observacion' => $row['observacion'] ?? 'Ninguna',
                ]);

                // 4. Vincular Guía a la Planilla (Pivot)
                $this->planilla->guias()->attach($guia->id);

                // 5. Actualizar Totales en Base de Datos (Seguro para Jobs en segundo plano)
                $this->planilla->increment('piezas', $row['piezas']);
                $this->planilla->increment('kilos', $row['peso']);
            }
        });
    }

    /**
     * Reglas de validación para las celdas del Excel.
     * WithValidation garantiza que si falla UNA, se cancela TODA la subida antes de insertar.
     */
    public function rules(): array
    {
        return [
            'cedula_origen'    => 'required|numeric',
            'nombre_origen'    => 'required|string|max:255',
            'cedula_destino'   => 'required|numeric',
            'nombre_destino'   => 'required|string|max:255',
            'piezas'           => 'required|numeric|min:1',
            'peso'             => 'required|numeric|min:0.1',
        ];
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
