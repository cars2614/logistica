<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guia extends Model
{
    protected $fillable = [
         'id_guias',
        'num_guias',
        'volumen',
        'peso' ,
        'precio' ,
        'observacion' ,
        'fecha_admision' ,
        'unidades' ,
    ];
}
