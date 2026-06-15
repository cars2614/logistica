<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoGuia extends Model
{
    use HasFactory;

    protected $table      = 'estado_guias';
    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha_estado',
        'estado',
        'descripcion',
        'id_guia',
        'id_usuario',
        'latitud',
        'longitud',
    ];

    public function guia()
    {
        return $this->belongsTo(Guia::class, 'id_guia', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}