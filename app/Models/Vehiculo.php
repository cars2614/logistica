<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vehiculos';

    // CORREGIDO: Se cambió 'tipo_vehiculo_id' por 'id_tipo_vehiculo'
    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'capacidad',
        'estado',
        'fecha_registro',
        'id_tipo_vehiculo', // Debe coincidir exactamente con tu base de datos y controlador
    ];

    /**
     * Relación con TipoVehiculo
     */
    public function tipoVehiculo()
    {
        // Se mantiene 'id_tipo_vehiculo' como la clave foránea correcta
        return $this->belongsTo(TipoVehiculo::class, 'id_tipo_vehiculo');
    }
}
