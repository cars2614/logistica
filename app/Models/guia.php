<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
    use HasFactory;

    // Indicamos el nombre real de la tabla en tu phpMyAdmin
    protected $table = 'guias';
    
    // CORREGIDO: Tu llave primaria se llama 'id' en la base de datos
    protected $primaryKey = 'id'; 

    // Columnas permitidas para registrar datos en masa
    protected $fillable = [
        'num_guias',
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

    // Relación con el cliente que envía (Origen)
    public function clienteOrigen()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente_origen');
    }

    // Relación con el cliente que recibe (Destino)
    public function clienteDestino()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente_destino');
    }

    // Relación con el tipo de entrega (Domicilio, etc.)
    public function tipoEntrega()
    {
        return $this->belongsTo(TipoEntrega::class, 'id_tipo_entrega');
    }

    // Relación con los estados por los que pasa la guía
    public function estadoGuias()
    {
        return $this->hasMany(EstadoGuia::class, 'id_guia');
    }

    // Relación con las planillas de transporte
    public function planillas()
    {
        return $this->hasMany(Planilla::class, 'id_guia');
    }
}