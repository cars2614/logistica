<?php

namespace App\Models; // Corregido: Debe apuntar a la carpeta Models

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    // Definimos la tabla ya que el plural de Ciudad en inglés no es automático
    protected $table = 'ciudads'; 

    protected $fillable = [
        'nombre',
        'codigo_postal',
    ];
}