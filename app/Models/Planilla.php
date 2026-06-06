<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;

    protected $table = 'planillas';

    // CORREGIDO: Agregamos 'numero_planilla' para que Laravel permita registrarlo desde el controlador
    protected $fillable = [
        'numero_planilla', // <-- Línea clave obligatoria
        'id_ciudad',
        'id_usuario',
        'id_ruta',
        'piezas',
        'kilos',
    ];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'id_ciudad');
    }

    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'id_ruta');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}