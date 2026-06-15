<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'guias';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'id',
        'id_tipo_entrega',
        'id_cliente_origen',
        'id_cliente_destino',
        'unidades',
        'peso',
        'largo',
        'ancho',
        'alto',
        'precio_envio',
        'valor_declarado',
        'observacion',
        'id_repartidor',
    ];

    // Relación clave: Vincula la guía con el cliente que envía
    public function clienteOrigen()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente_origen');
    }

    public function clienteDestino()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente_destino');
    }

    public function tipoEntrega()
    {
        return $this->belongsTo(TipoEntrega::class, 'id_tipo_entrega');
    }

    public function estados()
    {
        return $this->hasMany(EstadoGuia::class, 'id_guia');
    }

    public function getEstadoActualAttribute()
    {
        return $this->estados()->orderBy('id', 'desc')->first();
    }

    public function planillas()
    {
        return $this->belongsToMany(Planilla::class, 'detalles_planillas', 'id_guia', 'id_planilla');
    }

    public function repartidor()
    {
        return $this->belongsTo(User::class, 'id_repartidor');
    }
}