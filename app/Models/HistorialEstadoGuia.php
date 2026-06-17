<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialEstadoGuia extends Model
{
    use HasFactory;

    protected $table = 'historial_estados_guias';

    protected $fillable = [
        'guia_id',
        'estado',
        'observaciones',
        'user_id',
    ];

    public function guia()
    {
        return $this->belongsTo(Guia::class, 'guia_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
