<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruta extends Model
{
    use HasFactory, SoftDeletes;
=======

class Ruta extends Model
{
    use HasFactory;
>>>>>>> origin/juana

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