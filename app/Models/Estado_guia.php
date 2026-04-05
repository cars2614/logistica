<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado_guia extends Model
{
    protected $fillable = [
        'fecha_estado',
        'estado',
        'descripcion',
    ];
}
