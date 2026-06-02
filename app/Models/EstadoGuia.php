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
    ];

    public function guia()
    {
        return $this->belongsTo(Guia::class, 'id_guia', 'id_guias');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}