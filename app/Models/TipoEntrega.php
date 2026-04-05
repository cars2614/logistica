<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEntrega extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',

    ];
}
