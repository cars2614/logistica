<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
    use HasFactory;

    protected $table = 'guias';
    protected $primaryKey = 'id_guias';

    protected $fillable = [
        'num_guias',
        'volumen',
        'peso',
        'precio',
        'observacion',
        'fecha_admision',
        'unidades',
        'cliente_id',
        'tipo_entrega_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function tipoEntrega()
    {
        return $this->belongsTo(TipoEntrega::class, 'tipo_entrega_id');
    }

    public function estadoGuias()
    {
        return $this->hasMany(EstadoGuia::class, 'guia_id');
    }

    public function planillas()
    {
        return $this->hasMany(Planilla::class, 'guia_id');
    }
}