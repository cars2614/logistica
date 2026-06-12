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
<<<<<<< HEAD
        'fecha_estado',
        'estado',
        'descripcion',
        'id_guia',
        'id_usuario',
=======
        'fecha_estado', 'estado', 'descripcion',
        'id_guia', 'guia_id',
        'latitud', 'longitud',
>>>>>>> origin/juana
    ];

    public function guia()
    {
<<<<<<< HEAD
        return $this->belongsTo(Guia::class, 'id_guia', 'id_guias');
=======
        return $this->belongsTo(Guia::class, 'id_guia', 'id');
>>>>>>> origin/juana
    }

    public function usuario()
    {
<<<<<<< HEAD
        return $this->belongsTo(User::class, 'id_usuario');
=======
        return $this->belongsTo(Usuario::class, 'id_usuario');
>>>>>>> origin/juana
    }
}