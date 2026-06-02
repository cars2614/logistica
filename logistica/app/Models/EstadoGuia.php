<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoGuia extends Model
{
    use HasFactory;

    protected $table      = 'estado_guias';
    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha_estado',
        'estado',
        'descripcion',
        'guia_id',
    ];

    /**
     * Relación: un estado pertenece a una guía.
     * La clave primaria de guias es id_guias.
     */
    public function guia()
    {
        return $this->belongsTo(Guia::class, 'guia_id', 'id_guias');
    }
}
