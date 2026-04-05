<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
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
    ];
}
