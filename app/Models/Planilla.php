<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planilla extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'planillas';

    // CORREGIDO: Agregamos 'numero_planilla' para que Laravel permita registrarlo desde el controlador
    protected $fillable = [
        'numero_planilla', // <-- Línea clave obligatoria
        'id_ciudad',
        'id_ruta',
        'vehiculo_id',
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
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function guias()
    {
        return $this->belongsToMany(Guia::class, 'detalles_planillas', 'id_planilla', 'id_guia');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }
}
