<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEntrega extends Model
{
    protected $table = 'tipo_entregas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    /**
     * Retorna la etiqueta legible del estado.
     */
    public function getEstadoLabelAttribute(): string
    {
        return $this->estado ? 'Activo' : 'Inactivo';
    }

    /**
     * Retorna la clase Bootstrap del badge según el estado.
     */
    public function getEstadoBadgeAttribute(): string
    {
        return $this->estado ? 'badge-success' : 'badge-danger';
    }
}
