<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruta extends Model
{
    use HasFactory, SoftDeletes;

    protected $table      = 'rutas';
    protected $primaryKey = 'id';

    protected $fillable = [
    'zona',
    'guia',
    'direccion',
    'sector',
    'ciudad',
    'descripcion', // Déjalo si ya venía de antes
];

    /**
     * Una ruta tiene muchas planillas.
     * FK en planillas: ruta_id → rutas.id
     */
    public function planillas()
    {
        return $this->hasMany(Planilla::class, 'ruta_id', 'id');
    }
}