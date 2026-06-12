<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TrackingActualizado implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Propiedades públicas que viajarán automáticamente en el JSON del websocket
    public $guiaId;
    public $estado;
    public $descripcion;
    public $latitud;
    public $longitud;
    public $fecha;

    /**
     * Create a new event instance.
     */
    public function __construct($guiaId, $estado, $descripcion, $latitud, $longitud, $fecha = null)
    {
        $this->guiaId = $guiaId;
        $this->estado = $estado;
        $this->descripcion = $descripcion;
        $this->latitud = (float) $latitud;
        $this->longitud = (float) $longitud;
        $this->fecha = $fecha ?? now()->toDateTimeString();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        // Canal público para que el cliente final pueda escuchar sin iniciar sesión
        return [
            new Channel('tracking.' . $this->guiaId)
        ];
    }

    /**
     * Nombre personalizado del evento en JavaScript
     */
    public function broadcastAs(): string
    {
        return 'UbicacionActualizada';
    }
}
