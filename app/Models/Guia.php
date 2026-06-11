<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
    use HasFactory;

    protected $table = 'guias';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'volumen',
        'peso',
        'precio',
        'observacion',
        'fecha_admision',
        'unidades',
        'id_cliente_origen',
        'id_cliente_destino',
        'id_tipo_entrega',
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
}