<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'cedula',
        'telefono',
        'correo',
        'direccion',
        'descripcion',
        'id_ciudad',
    ];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'id_ciudad');
    }

    public function guiasOrigen()
    {
        return $this->hasMany(Guia::class, 'id_cliente_origen');
    }

    public function guiasDestino()
    {
        return $this->hasMany(Guia::class, 'id_cliente_destino');
    }
}
