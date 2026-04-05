<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ruta extends Model
{
    protected $fillable = [
         
            'zona',
            'guia',
            'direccion',
             'sector',
             'ciudad',
    ];
}
