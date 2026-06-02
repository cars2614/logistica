<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;

    protected $table      = 'planillas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'destinatario',
        'direccion',
        'comentario',
        'destino',
        'departamento',
        'entidad',
        'servicio',
        'piezas',
        'kilos',
        'opedor',
        'guia_id',
        'ruta_id',
    ];

    /**
     * Una planilla pertenece a una guía.
     * La PK de guias es id_guias (no el id estándar).
     */
    public function guia()
    {
        return $this->belongsTo(Guia::class, 'guia_id', 'id_guias');
    }

    /**
     * Una planilla pertenece a una ruta.
     */
    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'ruta_id', 'id');
    }
}